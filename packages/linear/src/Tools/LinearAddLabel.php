<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a label to a Linear issue by updating the issue's label list.
 */
class LinearAddLabel implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_add_label';
    }

    public function description(): string
    {
        return <<<'MD'
        Add a label to a Linear issue. Provide the issue ID or identifier
        and the label ID to add. The label will be appended to existing labels.
        Use linear_list_labels to find label IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'issue_id' => ['type' => 'string', 'required' => true, 'description' => 'Issue ID or identifier.'],
            'label_id' => ['type' => 'string', 'required' => true, 'description' => 'Label ID to add.'],
        ];
    }

    /**
     * Add a label to a Linear issue, preserving existing labels.
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

            // Merge and deduplicate
            $allLabelIds = array_unique(array_merge($existingLabels, [$labelId]));

            $result = $this->service->updateIssue($issueId, [
                'labelIds' => array_values($allLabelIds),
            ]);

            $issue = $result['data']['issueUpdate']['issue'] ?? null;
            if ($issue === null) {
                return ToolResult::error('Failed to add label to issue.');
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
