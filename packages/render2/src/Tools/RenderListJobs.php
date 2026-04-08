<?php

namespace OpenCompany\Integrations\Render2\Tools;

use OpenCompany\Integrations\Render2\RenderService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RenderListJobs implements Tool
{
    public function __construct(
        private RenderService $service,
    ) {}

    public function name(): string
    {
        return 'render_list_jobs';
    }

    public function description(): string
    {
        return 'List jobs for a specific Render service. Returns job IDs, status, start command, and timestamps.';
    }

    public function parameters(): array
    {
        return [
            'service_id' => ['type' => 'string', 'required' => true, 'description' => 'The service ID to list jobs for.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of jobs to return per page (default: 20, max: 100).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Render integration is not configured.');
            }

            $serviceId = $args['service_id'];
            $limit = isset($args['limit']) ? (int) $args['limit'] : null;
            $cursor = $args['cursor'] ?? null;

            $result = $this->service->listJobs($serviceId, $limit, $cursor);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
