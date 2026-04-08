<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Asana task.
 */
class AsanaUpdateTask implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_update_task';
    }

    public function description(): string
    {
        return 'Update an existing Asana task.';
    }

    public function parameters(): array
    {
        return [
            'id'        => ['type' => 'string',  'required' => true,  'description' => 'The task GID to update.'],
            'name'      => ['type' => 'string',  'description' => 'New name for the task.'],
            'notes'     => ['type' => 'string',  'description' => 'New description.'],
            'assignee'  => ['type' => 'string',  'description' => 'User GID to assign the task to, or "me".'],
            'due_on'    => ['type' => 'string',  'description' => 'Due date in YYYY-MM-DD format.'],
            'completed' => ['type' => 'boolean', 'description' => 'Set to true to mark the task complete.'],
            'tags'      => ['type' => 'array',   'description' => 'Array of tag GIDs to set on the task.'],
        ];
    }

    /**
     * Update a task's fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, name, notes, assignee, due_on, completed, tags)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $data = [];

            if (array_key_exists('name', $args)) {
                $data['name'] = $args['name'];
            }
            if (array_key_exists('notes', $args)) {
                $data['notes'] = $args['notes'];
            }
            if (array_key_exists('assignee', $args)) {
                $data['assignee'] = $args['assignee'];
            }
            if (array_key_exists('due_on', $args)) {
                $data['due_on'] = $args['due_on'];
            }
            if (array_key_exists('completed', $args)) {
                $data['completed'] = $args['completed'];
            }
            if (array_key_exists('tags', $args)) {
                $data['tags'] = $args['tags'];
            }

            $task = $this->service->updateTask($id, $data);

            return ToolResult::success($task);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
