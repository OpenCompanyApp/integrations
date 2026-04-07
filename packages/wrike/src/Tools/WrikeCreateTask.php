<?php

namespace OpenCompany\Integrations\Wrike\Tools;

use OpenCompany\Integrations\Wrike\WrikeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new task in Wrike.
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
        return 'Create a new task in Wrike.';
    }

    public function parameters(): array
    {
        return [
            'folderId'    => ['type' => 'string', 'required' => true,  'description' => 'Folder ID to create the task in.'],
            'title'       => ['type' => 'string', 'required' => true,  'description' => 'Title of the task.'],
            'description' => ['type' => 'string', 'description' => 'Detailed description of the task.'],
            'importance'  => ['type' => 'string', 'description' => 'Task importance (High, Normal, Low).'],
            'status'      => ['type' => 'string', 'description' => 'Task status (Active, Completed, Deferred).'],
            'dates'       => ['type' => 'object', 'description' => 'Date settings object (start, due, type).'],
            'assignees'   => ['type' => 'array',  'description' => 'Array of user IDs to assign the task to.'],
        ];
    }

    /**
     * Create a new task with the given details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (folderId, title, description, importance, status, dates, assignees)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Wrike integration is not configured.');
            }

            $folderId = $args['folderId'] ?? '';

            if (empty($folderId)) {
                return ToolResult::error('folderId is required.');
            }

            $title = $args['title'] ?? '';

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
            if (isset($args['status'])) {
                $data['status'] = $args['status'];
            }
            if (isset($args['dates'])) {
                $data['dates'] = $args['dates'];
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
