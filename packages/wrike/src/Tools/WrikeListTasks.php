<?php

namespace OpenCompany\Integrations\Wrike\Tools;

use OpenCompany\Integrations\Wrike\WrikeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List tasks in Wrike with optional filters.
 */
class WrikeListTasks implements Tool
{
    /**
     * @param  WrikeService  $service  The Wrike API client
     */
    public function __construct(
        private WrikeService $service,
    ) {}

    public function name(): string
    {
        return 'wrike_list_tasks';
    }

    public function description(): string
    {
        return 'List tasks in Wrike with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'folder_id'   => ['type' => 'string',  'description' => 'Folder ID to filter tasks by.'],
            'space_id'    => ['type' => 'string',  'description' => 'Space ID to filter tasks by.'],
            'status'      => ['type' => 'string',  'description' => 'Task status to filter by (e.g. Active, Completed, Deferred).'],
            'limit'       => ['type' => 'integer', 'description' => 'Max number of tasks to return.'],
            'page_token'  => ['type' => 'string',  'description' => 'Token for pagination from a previous response.'],
        ];
    }

    /**
     * Retrieve a list of tasks with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (folder_id, space_id, status, limit, page_token)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Wrike integration is not configured.');
            }

            $params = [];

            if (isset($args['folder_id'])) {
                $params['folderId'] = $args['folder_id'];
            }
            if (isset($args['space_id'])) {
                $params['spaceId'] = $args['space_id'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['page_token'])) {
                $params['pageToken'] = $args['page_token'];
            }

            $tasks = $this->service->listTasks($params);

            return ToolResult::success($tasks);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
