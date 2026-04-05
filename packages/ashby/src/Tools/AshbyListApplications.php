<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

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
        return 'List job applications from Ashby. Returns applications with candidate info, job title, current stage, and status. Supports filtering by job, candidate, stage, and status.';
    }

    public function parameters(): array
    {
        return [
            'job_id' => ['type' => 'string', 'description' => 'Filter by job ID.'],
            'candidate_id' => ['type' => 'string', 'description' => 'Filter by candidate ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by application status: "active", "hired", "rejected", "withdrawn". Omit to list all.'],
            'stage' => ['type' => 'string', 'description' => 'Filter by current stage name.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of applications to return per page (default: 50, max: 200).'],
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

            if (isset($args['job_id'])) {
                $body['jobId'] = $args['job_id'];
            }
            if (isset($args['candidate_id'])) {
                $body['candidateId'] = $args['candidate_id'];
            }
            if (isset($args['status'])) {
                $body['status'] = $args['status'];
            }
            if (isset($args['stage'])) {
                $body['stage'] = $args['stage'];
            }
            if (isset($args['limit'])) {
                $body['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $body['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listApplications($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
