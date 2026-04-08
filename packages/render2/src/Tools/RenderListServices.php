<?php

namespace OpenCompany\Integrations\Render2\Tools;

use OpenCompany\Integrations\Render2\RenderService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RenderListServices implements Tool
{
    public function __construct(
        private RenderService $service,
    ) {}

    public function name(): string
    {
        return 'render_list_services';
    }

    public function description(): string
    {
        return 'List all services in the Render account. Returns service IDs, names, type, status, and URLs.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of services to return per page (default: 20, max: 100).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Render integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : null;
            $cursor = $args['cursor'] ?? null;

            $result = $this->service->listServices($limit, $cursor);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
