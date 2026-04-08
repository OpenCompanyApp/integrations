<?php

namespace OpenCompany\Integrations\Freshteam\Tools;

use OpenCompany\Integrations\Freshteam\FreshteamService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshteamListJobPostings implements Tool
{
    public function __construct(
        private FreshteamService $service,
    ) {}

    public function name(): string
    {
        return 'freshteam_list_job_postings';
    }

    public function description(): string
    {
        return 'List job postings from Freshteam. Returns paginated job records with optional filtering by status and department.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 100).'],
            'status' => ['type' => 'string', 'description' => 'Filter job postings by status (e.g., "published", "draft", "closed", "on_hold").'],
            'department_id' => ['type' => 'integer', 'description' => 'Filter by department ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshteam integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 20;
            $status = $args['status'] ?? null;
            $departmentId = isset($args['department_id']) ? (int) $args['department_id'] : null;

            $result = $this->service->listJobPostings($page, $perPage, $status, $departmentId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
