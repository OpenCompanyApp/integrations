<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\Integrations\Todoist\TodoistService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TodoistGetProject implements Tool
{
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string { return 'todoist_get_project'; }
    public function description(): string { return 'Get detailed information about a Todoist project.'; }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }
            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }
            $project = $this->service->getProject($id);
            return ToolResult::success($project);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
