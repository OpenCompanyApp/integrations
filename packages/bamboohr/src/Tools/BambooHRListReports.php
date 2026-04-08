<?php

namespace OpenCompany\Integrations\BambooHR\Tools;

use OpenCompany\Integrations\BambooHR\BambooHRService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BambooHRListReports implements Tool
{
    public function __construct(
        private BambooHRService $service,
    ) {}

    public function name(): string
    {
        return 'bamboohr_list_reports';
    }

    public function description(): string
    {
        return 'Generate a custom report from BambooHR. Specify which employee fields to include in the report results.';
    }

    public function parameters(): array
    {
        return [
            'fields' => ['type' => 'array', 'required' => true, 'description' => 'List of employee fields to include in the report (e.g., ["firstName", "lastName", "jobTitle", "department", "workEmail", "hireDate", "status"]).'],
            'title' => ['type' => 'string', 'description' => 'Optional title for the custom report.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BambooHR integration is not configured.');
            }

            $fields = $args['fields'];
            $title = $args['title'] ?? 'Custom Report';

            if (empty($fields)) {
                return ToolResult::error('At least one field must be specified for the report.');
            }

            $result = $this->service->listReports($fields, $title);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
