<?php

namespace OpenCompany\Integrations\MicrosoftPowerBI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MicrosoftPowerBI\PowerBIService;

class PowerBIGetReport implements Tool
{
    public function __construct(
        private PowerBIService $service,
    ) {}

    public function name(): string
    {
        return 'powerbi_get_report';
    }

    public function description(): string
    {
        return 'Get details of a specific Power BI report by ID. Returns the report name, embed URL, dataset ID, and other metadata.';
    }

    public function parameters(): array
    {
        return [
            'report_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The unique ID of the Power BI report (GUID format).',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Power BI integration is not configured.');
            }

            $reportId = $args['report_id'] ?? '';
            if (empty($reportId)) {
                return ToolResult::error('report_id is required.');
            }

            $result = $this->service->getReport($reportId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
