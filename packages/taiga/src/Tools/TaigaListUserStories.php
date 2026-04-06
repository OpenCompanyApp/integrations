<?php

namespace OpenCompany\Integrations\Taiga\Tools;

use OpenCompany\Integrations\Taiga\TaigaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List user stories from Taiga, optionally filtered by project, status, or other criteria.
 *
 * Returns user story subjects, descriptions, statuses, assignees, and points.
 */
class TaigaListUserStories implements Tool
{
    public function __construct(
        private TaigaService $service,
    ) {}

    public function name(): string
    {
        return 'taiga_list_user_stories';
    }

    public function description(): string
    {
        return 'List user stories from Taiga. Filter by project, status, milestone, or assignee. Returns story subjects, descriptions, and statuses.';
    }

    public function parameters(): array
    {
        return [
            'project' => ['type' => 'integer', 'description' => 'Filter by project ID.'],
            'project__slug' => ['type' => 'string', 'description' => 'Filter by project slug (e.g., "my-project").'],
            'status' => ['type' => 'string', 'description' => 'Filter by status name (e.g., "New", "In progress", "Ready for test", "Done").'],
            'milestone' => ['type' => 'integer', 'description' => 'Filter by milestone (sprint) ID.'],
            'assigned_to' => ['type' => 'integer', 'description' => 'Filter by assigned user ID.'],
            'tags' => ['type' => 'string', 'description' => 'Filter by tags as a comma-separated string.'],
            'order_by' => ['type' => 'string', 'description' => 'Order results (e.g., "subject", "-created_date", "backlog_order").'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 40).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Taiga integration is not configured.');
            }

            $params = [];
            foreach (['project', 'project__slug', 'status', 'milestone', 'assigned_to', 'tags', 'order_by', 'page', 'page_size'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listUserStories($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
