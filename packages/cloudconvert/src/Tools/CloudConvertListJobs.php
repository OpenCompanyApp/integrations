<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

use OpenCompany\Integrations\CloudConvert\CloudConvertService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CloudConvertListJobs implements Tool
{
    public function __construct(
        private CloudConvertService $service,
    ) {}

    public function name(): string
    {
        return 'cloudconvert_list_jobs';
    }

    public function description(): string
    {
        return 'List CloudConvert jobs with optional filtering by status or tag, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of jobs per page (default: 20, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: waiting, processing, finished, error.'],
            'tag' => ['type' => 'string', 'description' => 'Filter by job tag.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CloudConvert integration is not configured.');
            }

            $result = $this->service->listJobs(
                perPage: (int) ($args['per_page'] ?? 20),
                page: (int) ($args['page'] ?? 1),
                status: $args['status'] ?? null,
                tag: $args['tag'] ?? null,
            );

            $data = $result['data'] ?? $result;

            return ToolResult::success($data);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
