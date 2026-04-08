<?php

namespace OpenCompany\Integrations\MicrosoftPowerBI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MicrosoftPowerBI\PowerBIService;

class PowerBIListWorkspaces implements Tool
{
    public function __construct(
        private PowerBIService $service,
    ) {}

    public function name(): string
    {
        return 'powerbi_list_workspaces';
    }

    public function description(): string
    {
        return 'List all Power BI workspaces (groups) the authenticated user has access to. Returns workspace names, IDs, and isolation modes.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Power BI integration is not configured.');
            }

            $result = $this->service->listWorkspaces();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
