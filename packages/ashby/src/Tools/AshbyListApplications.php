<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List job applications from Ashby ATS.
 *
 * Supports pagination and filtering by job ID and status.
 */
class AshbyListApplications implements Tool
{
    public function __construct(
        private AshbyService $service,
    ) {}

    public function name(): string
    {
        return 'ashby_list_applications';
    }

    public function description(): string
    {
        return 'List job applications in Ashby. Returns applications with candidate info, status, and associated job. Use filters to narrow by job or status.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of applications to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of results to skip for pagination.'],
            'job_id' => ['type' => 'string', 'description' => 'Filter applications by job ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by application status (e.g., "hired", "rejected", "active").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ashby integration is not configured.');
            }

            $result = $this->service->listApplications(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                offset: isset($args['offset']) ? (int) $args['offset'] : null,
                jobId: $args['job_id'] ?? null,
                status: $args['status'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
