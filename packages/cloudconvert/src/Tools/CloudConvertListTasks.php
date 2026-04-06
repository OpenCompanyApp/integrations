<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

use OpenCompany\Integrations\CloudConvert\CloudConvertService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CloudConvertListTasks implements Tool
{
    public function __construct(
        private CloudConvertService $service,
    ) {}

    public function name(): string
    {
        return 'cloudconvert_list_tasks';
    }

    public function description(): string
    {
        return 'List CloudConvert tasks with optional filtering by status, operation, or job ID, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of tasks per page (default: 20, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: waiting, processing, finished, error.'],
            'operation' => ['type' => 'string', 'description' => 'Filter by operation type (e.g., "convert", "import/url").'],
            'job_id' => ['type' => 'string', 'description' => 'Filter by job ID to list tasks for a specific job.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CloudConvert integration is not configured.');
            }

            $result = $this->service->listTasks(
                perPage: (int) ($args['per_page'] ?? 20),
                page: (int) ($args['page'] ?? 1),
                status: $args['status'] ?? null,
                operation: $args['operation'] ?? null,
                jobId: $args['job_id'] ?? null,
            );

            $data = $result['data'] ?? $result;

            return ToolResult::success($data);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
