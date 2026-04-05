<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Remove a label from a Linear issue by updating the issue's label list.
 */
class LinearRemoveLabel implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_remove_label';
    }

    public function description(): string
    {
        return <<<'MD'
        Remove a label from a Linear issue. Provide the issue ID or identifier
        and the label ID to remove. Other labels on the issue are preserved.
        MD;
    }

    public function parameters(): array
    {
        return [
            'issue_id' => ['type' => 'string', 'required' => true, 'description' => 'Issue ID or identifier.'],
            'label_id' => ['type' => 'string', 'required' => true, 'description' => 'Label ID to remove.'],
        ];
    }

    /**
     * Remove a label from a Linear issue, preserving other labels.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $issueId = $args['issue_id'] ?? '';
            $labelId = $args['label_id'] ?? '';

            if (empty($issueId)) {
                return ToolResult::error('issue_id is required.');
            }
            if (empty($labelId)) {
                return ToolResult::error('label_id is required.');
            }

            // First, get the current issue to retrieve existing label IDs
            $current = $this->service->getIssue($issueId);
            $existingLabels = array_map(
                fn (array $l) => $l['id'] ?? '',
                $current['data']['issue']['labels']['nodes'] ?? []
            );

            // Remove the specified label
            $remainingLabelIds = array_values(array_filter($existingLabels, fn ($id) => $id !== $labelId));

            $result = $this->service->updateIssue($issueId, [
                'labelIds' => $remainingLabelIds,
            ]);

            $issue = $result['data']['issueUpdate']['issue'] ?? null;
            if ($issue === null) {
                return ToolResult::error('Failed to remove label from issue.');
            }

            return ToolResult::success([
                'id' => $issue['id'] ?? '',
                'identifier' => $issue['identifier'] ?? '',
                'labels' => array_map(fn (array $l) => $l['name'] ?? '', $issue['labels']['nodes'] ?? []),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
