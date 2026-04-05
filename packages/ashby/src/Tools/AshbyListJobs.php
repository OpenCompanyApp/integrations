<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AshbyListJobs implements Tool
{
    public function __construct(
        private AshbyService $service,
    ) {}

    public function name(): string
    {
        return 'ashby_list_jobs';
    }

    public function description(): string
    {
        return 'List jobs from Ashby. Returns job postings with their titles, statuses, departments, and locations. Supports filtering by status, department, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by job status: "open", "closed", "draft", "archived". Omit to list all.'],
            'department_id' => ['type' => 'string', 'description' => 'Filter by department ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of jobs to return per page (default: 50, max: 200).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of results to skip for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ashby integration is not configured.');
            }

            $body = [];

            if (isset($args['status'])) {
                $body['status'] = $args['status'];
            }
            if (isset($args['department_id'])) {
                $body['departmentId'] = $args['department_id'];
            }
            if (isset($args['limit'])) {
                $body['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $body['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listJobs($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
