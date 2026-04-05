<?php

namespace OpenCompany\Integrations\Teamwork\Tools;

use OpenCompany\Integrations\Teamwork\TeamworkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: teamwork_get_project
 *
 * Get details for a single Teamwork project.
 */
class TeamworkGetProject implements Tool
{
    public function __construct(
        private TeamworkService $service,
    ) {}

    public function name(): string
    {
        return 'teamwork_get_project';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Teamwork project, including description, status, dates, and people.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'required' => true, 'description' => 'The project ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Teamwork integration is not configured.');
            }

            $result = $this->service->getProject((int) $args['project_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
