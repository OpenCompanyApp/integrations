<?php

namespace OpenCompany\Integrations\BambooHR\Tools;

use OpenCompany\Integrations\BambooHR\BambooHRService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BambooHRUpdateEmployee implements Tool
{
    public function __construct(
        private BambooHRService $service,
    ) {}

    public function name(): string
    {
        return 'bamboohr_update_employee';
    }

    public function description(): string
    {
        return 'Update an existing employee in BambooHR. Provide the employee ID and the fields to update.';
    }

    public function parameters(): array
    {
        return [
            'employee_id' => ['type' => 'integer', 'required' => true, 'description' => 'The BambooHR employee ID to update.'],
            'first_name' => ['type' => 'string', 'description' => 'Updated first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Updated last name.'],
            'work_email' => ['type' => 'string', 'description' => 'Updated work email.'],
            'job_title' => ['type' => 'string', 'description' => 'Updated job title.'],
            'department' => ['type' => 'string', 'description' => 'Updated department.'],
            'status' => ['type' => 'string', 'description' => 'Updated employment status.'],
            'location' => ['type' => 'string', 'description' => 'Updated work location.'],
            'supervisor_id' => ['type' => 'integer', 'description' => 'Updated supervisor employee ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('BambooHR integration is not configured.');
            }

            $employeeId = $args['employee_id'];
            $data = [];

            $fieldMap = [
                'first_name' => 'firstName',
                'last_name' => 'lastName',
                'work_email' => 'workEmail',
                'job_title' => 'jobTitle',
                'department' => 'department',
                'status' => 'status',
                'location' => 'location',
                'supervisor_id' => 'supervisorEId',
            ];

            foreach ($fieldMap as $param => $apiField) {
                if (isset($args[$param])) {
                    $data[$apiField] = $args[$param];
                }
            }

            if (empty($data)) {
                return ToolResult::error('No fields provided to update.');
            }

            $result = $this->service->updateEmployee($employeeId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
