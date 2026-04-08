<?php

namespace OpenCompany\Integrations\BambooHR\Tools;

use OpenCompany\Integrations\BambooHR\BambooHRService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BambooHRCreateEmployee implements Tool
{
    public function __construct(
        private BambooHRService $service,
    ) {}

    public function name(): string
    {
        return 'bamboohr_create_employee';
    }

    public function description(): string
    {
        return 'Create a new employee in BambooHR. Provide employee data such as first name, last name, work email, job title, and department.';
    }

    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'required' => true, 'description' => 'Employee first name.'],
            'last_name' => ['type' => 'string', 'required' => true, 'description' => 'Employee last name.'],
            'work_email' => ['type' => 'string', 'description' => 'Employee work email address.'],
            'job_title' => ['type' => 'string', 'description' => 'Job title.'],
            'department' => ['type' => 'string', 'description' => 'Department name.'],
            'hire_date' => ['type' => 'string', 'description' => 'Hire date (YYYY-MM-DD).'],
            'status' => ['type' => 'string', 'description' => 'Employment status (e.g., "Active", "Inactive").'],
            'location' => ['type' => 'string', 'description' => 'Work location.'],
            'supervisor_id' => ['type' => 'integer', 'description' => 'Employee ID of the supervisor/manager.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BambooHR integration is not configured.');
            }

            $data = [];

            // Map camelCase API fields from snake_case parameters
            $fieldMap = [
                'first_name' => 'firstName',
                'last_name' => 'lastName',
                'work_email' => 'workEmail',
                'job_title' => 'jobTitle',
                'department' => 'department',
                'hire_date' => 'hireDate',
                'status' => 'status',
                'location' => 'location',
                'supervisor_id' => 'supervisorEId',
            ];

            foreach ($fieldMap as $param => $apiField) {
                if (isset($args[$param])) {
                    $data[$apiField] = $args[$param];
                }
            }

            $result = $this->service->createEmployee($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
