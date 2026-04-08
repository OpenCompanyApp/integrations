<?php

namespace OpenCompany\Integrations\BambooHR\Tools;

use OpenCompany\Integrations\BambooHR\BambooHRService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BambooHRGetEmployee implements Tool
{
    public function __construct(
        private BambooHRService $service,
    ) {}

    public function name(): string
    {
        return 'bamboohr_get_employee';
    }

    public function description(): string
    {
        return 'Get detailed information for a specific BambooHR employee by ID. Optionally specify which fields to retrieve.';
    }

    public function parameters(): array
    {
        return [
            'employee_id' => ['type' => 'integer', 'required' => true, 'description' => 'The BambooHR employee ID.'],
            'fields' => ['type' => 'array', 'description' => 'List of fields to retrieve (e.g., ["firstName", "lastName", "jobTitle", "workEmail", "department", "hireDate", "status"]). If omitted, returns default fields.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BambooHR integration is not configured.');
            }

            $employeeId = $args['employee_id'];
            $fields = $args['fields'] ?? [];

            $result = $this->service->getEmployee($employeeId, $fields);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
