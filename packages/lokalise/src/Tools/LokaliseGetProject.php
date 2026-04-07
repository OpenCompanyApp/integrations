<?php

namespace OpenCompany\Integrations\Lokalise\Tools;

use OpenCompany\Integrations\Lokalise\LokaliseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LokaliseGetProject implements Tool
{
    public function __construct(
        private LokaliseService $service,
    ) {}

    public function name(): string
    {
        return 'lokalise_get_project';
    }

    public function description(): string
    {
        return 'Get details of a specific Lokalise project. Returns project name, description, languages, statistics, and settings.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The project ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lokalise integration is not configured.');
            }

            $projectId = $args['project_id'];
            $result = $this->service->getProject($projectId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
