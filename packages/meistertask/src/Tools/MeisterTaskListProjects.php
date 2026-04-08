<?php

namespace OpenCompany\Integrations\MeisterTask\Tools;

use OpenCompany\Integrations\MeisterTask\MeisterTaskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MeisterTaskListProjects implements Tool
{
    public function __construct(
        private MeisterTaskService $service,
    ) {}

    public function name(): string
    {
        return 'meistertask_list_projects';
    }

    public function description(): string
    {
        return 'List all MeisterTask projects the authenticated user has access to. Returns project IDs, names, and basic metadata.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MeisterTask integration is not configured.');
            }

            $result = $this->service->listProjects();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
