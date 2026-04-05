<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Linear project's name, description, or state.
 */
class LinearUpdateProject implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_update_project';
    }

    public function description(): string
    {
        return <<<'MD'
        Update a Linear project. Provide the project ID and any fields to change.
        Only specified fields will be updated.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Project ID to update.'],
            'name' => ['type' => 'string', 'description' => 'New project name.'],
            'description' => ['type' => 'string', 'description' => 'New description.'],
            'state' => ['type' => 'string', 'description' => 'New project state (e.g., "planned", "active", "paused", "completed", "canceled").'],
        ];
    }

    /**
     * Update a Linear project with the given field changes.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $input = [];

            if (isset($args['name'])) {
                $input['name'] = $args['name'];
            }
            if (isset($args['description'])) {
                $input['description'] = $args['description'];
            }
            if (isset($args['state'])) {
                $input['state'] = $args['state'];
            }

            if (empty($input)) {
                return ToolResult::error('No fields provided to update.');
            }

            $result = $this->service->updateProject($id, $input);
            $project = $result['data']['projectUpdate']['project'] ?? null;

            if ($project === null) {
                return ToolResult::error('Failed to update project.');
            }

            return ToolResult::success([
                'id' => $project['id'] ?? '',
                'name' => $project['name'] ?? '',
                'description' => $project['description'] ?? '',
                'state' => $project['state'] ?? '',
                'url' => $project['url'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
