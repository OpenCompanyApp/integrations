<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\Integrations\Todoist\TodoistService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TodoistListProjects implements Tool
{
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string { return 'todoist_list_projects'; }
    public function description(): string { return 'List all projects in Todoist.'; }

    public function parameters(): array
    {
        return [
            'ids' => ['type' => 'array', 'description' => 'Array of project IDs to fetch.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }
            $params = [];
            if (isset($args['ids'])) { $params['ids'] = $args['ids']; }
            $projects = $this->service->listProjects($params);
            return ToolResult::success($projects);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
