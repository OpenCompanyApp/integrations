<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new task in Asana.
 */
class AsanaCreateTask implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_create_task';
    }

    public function description(): string
    {
        return 'Create a new task in Asana.';
    }

    public function parameters(): array
    {
        return [
            'name'      => ['type' => 'string', 'required' => true,  'description' => 'Name of the task.'],
            'notes'     => ['type' => 'string', 'description' => 'Free-form textual description (supports HTML).'],
            'projects'  => ['type' => 'array',  'description' => 'Array of project GIDs to add the task to.'],
            'assignee'  => ['type' => 'string', 'description' => 'User GID to assign the task to, or "me".'],
            'due_on'    => ['type' => 'string', 'description' => 'Due date in YYYY-MM-DD format.'],
            'tags'      => ['type' => 'array',  'description' => 'Array of tag GIDs to add to the task.'],
            'workspace' => ['type' => 'string', 'description' => 'Workspace GID (required if not adding to a project).'],
        ];
    }

    /**
     * Create a new task with the given details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, notes, projects, assignee, due_on, tags, workspace)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $name = $args['name'] ?? '';

            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = ['name' => $name];

            if (isset($args['notes'])) {
                $data['notes'] = $args['notes'];
            }
            if (isset($args['projects'])) {
                $data['projects'] = $args['projects'];
            }
            if (isset($args['assignee'])) {
                $data['assignee'] = $args['assignee'];
            }
            if (isset($args['due_on'])) {
                $data['due_on'] = $args['due_on'];
            }
            if (isset($args['tags'])) {
                $data['tags'] = $args['tags'];
            }
            if (isset($args['workspace'])) {
                $data['workspace'] = $args['workspace'];
            }

            $task = $this->service->createTask($data);

            return ToolResult::success($task);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
