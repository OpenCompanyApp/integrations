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
            'folderId'  => ['type' => 'string',  'description' => 'Folder ID to list tasks from.'],
            'status'    => ['type' => 'string',  'description' => 'Filter by status (e.g. Active, Completed, Deferred).'],
            'importance' => ['type' => 'string', 'description' => 'Filter by importance (e.g. High, Normal, Low).'],
            'limit'     => ['type' => 'integer', 'description' => 'Max number of tasks to return.'],
            'nextPageToken' => ['type' => 'string', 'description' => 'Cursor for pagination from a previous response.'],
        ];
    }

    /**
     * Retrieve a list of tasks with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (folderId, status, importance, limit, nextPageToken)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Wrike integration is not configured.');
            }

            $params = [];

            if (isset($args['folderId'])) {
                $params['folderId'] = $args['folderId'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['importance'])) {
                $params['importance'] = $args['importance'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['nextPageToken'])) {
                $params['nextPageToken'] = $args['nextPageToken'];
            }

            $tasks = $this->service->listTasks($params);

            return ToolResult::success($tasks);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
