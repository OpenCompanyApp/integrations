<?php

namespace OpenCompany\Integrations\Asana\Tools;

use OpenCompany\Integrations\Asana\AsanaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a subtask under an existing Asana task.
 */
class AsanaCreateSubtask implements Tool
{
    /**
     * @param  AsanaService  $service  The Asana API client
     */
    public function __construct(
        private AsanaService $service,
    ) {}

    public function name(): string
    {
        return 'asana_create_subtask';
    }

    public function description(): string
    {
        return 'Create a subtask under an existing Asana task.';
    }

    public function parameters(): array
    {
        return [
            'parent_id' => ['type' => 'string', 'required' => true,  'description' => 'GID of the parent task.'],
            'name'      => ['type' => 'string', 'required' => true,  'description' => 'Name of the subtask.'],
            'notes'     => ['type' => 'string', 'description' => 'Description for the subtask.'],
            'assignee'  => ['type' => 'string', 'description' => 'User GID to assign the subtask to, or "me".'],
        ];
    }

    /**
     * Create a subtask under the specified parent task.
     *
     * @param  array<string, mixed>  $args  Tool arguments (parent_id, name, notes, assignee)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Asana integration is not configured.');
            }

            $parentId = $args['parent_id'] ?? '';
            $name = $args['name'] ?? '';

            if (empty($parentId)) {
                return ToolResult::error('parent_id is required.');
            }
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = ['name' => $name];

            if (isset($args['notes'])) {
                $data['notes'] = $args['notes'];
            }
            if (isset($args['assignee'])) {
                $data['assignee'] = $args['assignee'];
            }

            $subtask = $this->service->createSubtask($parentId, $data);

            return ToolResult::success($subtask);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
