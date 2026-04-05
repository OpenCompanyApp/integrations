<?php

namespace OpenCompany\Integrations\Wealthbox\Tools;

use OpenCompany\Integrations\Wealthbox\WealthboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WealthboxListTasks implements Tool
{
    /**
     * Create a new WealthboxListTasks tool instance.
     */
    public function __construct(
        private WealthboxService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'wealthbox_list_tasks';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List tasks from Wealthbox CRM. Returns a paginated list of tasks with their details including name, due date, status, and assignee.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of tasks per page (default: 25, max: 200).'],
            'status' => ['type' => 'string', 'description' => 'Filter by task status (e.g., "open", "completed").'],
        ];
    }

    /**
     * Execute the list tasks tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wealthbox integration is not configured.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }

            $result = $this->service->listTasks($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
