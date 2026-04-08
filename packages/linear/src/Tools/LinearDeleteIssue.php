<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Linear issue by ID or identifier.
 */
class LinearDeleteIssue implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_delete_issue';
    }

    public function description(): string
    {
        return <<<'MD'
        Delete a Linear issue by ID or identifier. This action is irreversible.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Issue ID or identifier to delete (e.g., "TEAM-123").'],
        ];
    }

    /**
     * Delete a Linear issue permanently.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->deleteIssue($id);
            $success = $result['data']['issueDelete']['success'] ?? false;

            if (! $success) {
                return ToolResult::error("Failed to delete issue: {$id}");
            }

            return ToolResult::success([
                'deleted' => true,
                'id' => $id,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
