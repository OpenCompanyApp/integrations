<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List comments (stories) on an Asana task.
 */
class AsanaListComments implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_list_comments';
    }

    public function description(): string
    {
        return 'List comments (stories) on an Asana task.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string',  'required' => true,  'description' => 'GID of the task to list comments for.'],
            'limit'   => ['type' => 'integer', 'description' => 'Max number of comments to return (1–100).'],
            'offset'  => ['type' => 'string',  'description' => 'Cursor for pagination from a previous response.'],
        ];
    }

    /**
     * Retrieve comments for the specified task.
     *
     * @param  array<string, mixed>  $args  Tool arguments (task_id, limit, offset)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $taskId = $args['task_id'] ?? '';

            if (empty($taskId)) {
                return ToolResult::error('task_id is required.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = $args['offset'];
            }

            $comments = $this->service->listComments($taskId, $params);

            return ToolResult::success($comments);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
