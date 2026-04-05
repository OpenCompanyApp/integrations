<?php

namespace OpenCompany\Integrations\MicrosoftPowerBI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MicrosoftPowerBI\PowerBIService;

class PowerBIListDatasets implements Tool
{
    public function __construct(
        private PowerBIService $service,
    ) {}

    public function name(): string
    {
        return 'powerbi_list_datasets';
    }

    public function description(): string
    {
        return 'List all Power BI datasets the authenticated user has access to. Returns dataset names, IDs, and workspace associations.';
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

            $result = $this->service->listDatasets();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
