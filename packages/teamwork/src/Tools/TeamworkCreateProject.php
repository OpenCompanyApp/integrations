<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: teamwork_create_project
 *
 * Create a new project in Teamwork.
 */
class TeamworkCreateProject implements Tool
{
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_create_project';
    }

    public function description(): string
    {
        return 'Create a new project in Teamwork. Provide a name and optional description.';
    }

    public function parameters(): array
    {
        return [
            'name'        => ['type' => 'string', 'required' => true, 'description' => 'Project name.'],
            'description' => ['type' => 'string', 'description' => 'Project description (optional).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $name        = $args['name'];
            $description = $args['description'] ?? '';

            $result = $this->service->createProject($name, $description);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
