<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AshbyListInterviews implements Tool
{
    public function __construct(
        private AshbyService $service,
    ) {}

    public function name(): string
    {
        return 'ashby_list_interviews';
    }

    public function description(): string
    {
        return 'List scheduled interviews from Ashby. Returns interviews with date, time, interviewers, candidate info, and stage. Supports filtering by job, application, interviewer, and date range.';
    }

    public function parameters(): array
    {
        return [
            'job_id' => ['type' => 'string', 'description' => 'Filter by job ID.'],
            'application_id' => ['type' => 'string', 'description' => 'Filter by application ID.'],
            'interviewer_id' => ['type' => 'string', 'description' => 'Filter by interviewer user ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by interview status: "scheduled", "completed", "cancelled", "needs_scheduling".'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of interviews to return per page (default: 50, max: 200).'],
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
            if (isset($args['application_id'])) {
                $body['applicationId'] = $args['application_id'];
            }
            if (isset($args['interviewer_id'])) {
                $body['interviewerId'] = $args['interviewer_id'];
            }
            if (isset($args['status'])) {
                $body['status'] = $args['status'];
            }
            if (isset($args['limit'])) {
                $body['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $body['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listInterviews($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
