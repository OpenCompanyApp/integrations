<?php

namespace OpenCompany\Integrations\ServiceM8\Tools;

use OpenCompany\Integrations\ServiceM8\ServiceM8Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List jobs from ServiceM8.
 *
 * Returns a list of jobs with optional filtering by status, date, and pagination.
 */
class ServiceM8ListJobs implements Tool
{
    public function __construct(
        private ServiceM8Service $service,
    ) {}

    public function name(): string
    {
        return 'servicem8_list_jobs';
    }

    public function description(): string
    {
        return 'List jobs from ServiceM8. Returns job details including status, client, dates, and descriptions. Supports filtering by status and pagination.';
    }

    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Filter by job status (e.g. "open", "in_progress", "completed", "cancelled").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of jobs to return per page.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of records to skip for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ServiceM8 integration is not configured.');
            }

            $params = [];
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listJobs($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
