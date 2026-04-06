<?php

namespace OpenCompany\Integrations\ServiceM8\Tools;

use OpenCompany\Integrations\ServiceM8\ServiceM8Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List activities from ServiceM8.
 *
 * Returns a timeline of activity records such as job status changes, comments,
 * and attachments.
 */
class ServiceM8ListActivities implements Tool
{
    public function __construct(
        private ServiceM8Service $service,
    ) {}

    public function name(): string
    {
        return 'servicem8_list_activities';
    }

    public function description(): string
    {
        return 'List activity records from ServiceM8. Returns a timeline of events such as job status changes, comments, and notes. Supports filtering by job and pagination.';
    }

    public function parameters(): array
    {
        return [
            'job_uuid' => ['type' => 'string', 'description' => 'Filter activities to a specific job by its UUID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of activities to return per page.'],
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
            if (isset($args['job_uuid'])) {
                $params['job_uuid'] = $args['job_uuid'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listActivities($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
