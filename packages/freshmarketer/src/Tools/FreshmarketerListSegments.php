<?php

namespace OpenCompany\Integrations\Freshmarketer\Tools;

use OpenCompany\Integrations\Freshmarketer\FreshmarketerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FreshmarketerListSegments — list contact segments with pagination.
 *
 * Calls POST /api/v1/segments with page and limit parameters.
 */
class FreshmarketerListSegments implements Tool
{
    public function __construct(
        private FreshmarketerService $service,
    ) {}

    public function name(): string
    {
        return 'freshmarketer_list_segments';
    }

    public function description(): string
    {
        return 'List contact segments in Freshmarketer. Supports pagination to browse through all segments.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of segments per page (default: 20).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshmarketer integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;

            $result = $this->service->listSegments($page, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
