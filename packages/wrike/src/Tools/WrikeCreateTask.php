<?php

namespace OpenCompany\Integrations\Wrike\Tools;

use OpenCompany\Integrations\Wrike\WrikeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new task in a Wrike folder.
 */
class WrikeCreateTask implements Tool
{
    /**
     * @param  WrikeService  $service  The Wrike API client
     */
    public function __construct(
        private WrikeService $service,
    ) {}

    public function name(): string
    {
        return 'wrike_create_task';
    }

    public function description(): string
    {
        return 'Create a new task in a Wrike folder.';
    }

    public function parameters(): array
    {
        return [
            'folder_id'     => ['type' => 'string', 'required' => true,  'description' => 'The folder ID to create the task in.'],
            'title'         => ['type' => 'string', 'required' => true,  'description' => 'Title of the task.'],
            'description'   => ['type' => 'string', 'description' => 'Detailed description of the task.'],
            'importance'    => ['type' => 'string', 'description' => 'Task importance: High, Normal, or Low.'],
            'dates_start'   => ['type' => 'string', 'description' => 'Start date in YYYY-MM-DD format.'],
            'dates_due'     => ['type' => 'string', 'description' => 'Due date in YYYY-MM-DD format.'],
            'assignees'     => ['type' => 'array',  'description' => 'Array of contact IDs to assign the task to.'],
        ];
    }

    /**
     * Create a new task with the given details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (folder_id, title, description, importance, dates_start, dates_due, assignees)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Wrike integration is not configured.');
            }

            $folderId = $args['folder_id'] ?? '';
            $title = $args['title'] ?? '';

            if (empty($folderId)) {
                return ToolResult::error('folder_id is required.');
            }
            if (empty($title)) {
                return ToolResult::error('title is required.');
            }

            $data = ['title' => $title];

            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['importance'])) {
                $data['importance'] = $args['importance'];
            }

            $dates = [];
            if (isset($args['dates_start'])) {
                $dates['start'] = $args['dates_start'];
            }
            if (isset($args['dates_due'])) {
                $dates['due'] = $args['dates_due'];
            }
            if (! empty($dates)) {
                $data['dates'] = $dates;
            }

            if (isset($args['assignees'])) {
                $data['responsibles'] = $args['assignees'];
            }

            $task = $this->service->createTask($folderId, $data);

            return ToolResult::success($task);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
