<?php

namespace OpenCompany\Integrations\Missive\Tools;

use OpenCompany\Integrations\Missive\MissiveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: missive_list_tasks
 *
 * List tasks from Missive with optional filters and pagination.
 * Supports filtering by state and assignee.
 */
class MissiveListTasks implements Tool
{
    /**
     * @param  MissiveService  $service  The Missive API service instance.
     */
    public function __construct(
        private MissiveService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'missive_list_tasks';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List tasks from Missive. Supports filtering by state and assignee. Returns paginated results.';
    }

    /**
     * Define the accepted parameters.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'state' => ['type' => 'string', 'description' => 'Filter by task state: "open" or "completed".'],
            'assignee' => ['type' => 'string', 'description' => 'Filter by assignee user ID or email.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of tasks to return (default: 25, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
        ];
    }

    /**
     * Execute the tool — list tasks from Missive.
     *
     * @param  array<string, mixed>  $args  The input parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Missive integration is not configured.');
            }

            $params = [];

            if (isset($args['state'])) {
                $params['state'] = $args['state'];
            }
            if (isset($args['assignee'])) {
                $params['assignee'] = $args['assignee'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listTasks($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
