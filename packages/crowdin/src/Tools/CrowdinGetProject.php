<?php

namespace OpenCompany\Integrations\Crowdin\Tools;

use OpenCompany\Integrations\Crowdin\CrowdinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific project from the Crowdin API.
 *
 * Returns project metadata including name, description, target languages,
 * and source language.
 */
class CrowdinGetProject implements Tool
{
    public function __construct(
        private CrowdinService $service,
    ) {}

    public function name(): string
    {
        return 'crowdin_get_project';
    }

    public function description(): string
    {
        return 'Get details of a specific Crowdin project by ID. Returns project name, description, source/target languages, and other settings.';
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
                return ToolResult::error('Crowdin integration is not configured.');
            }

            $projectId = $args['project_id'];
            $result = $this->service->getProject($projectId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
