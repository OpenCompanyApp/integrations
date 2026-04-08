<?php

namespace OpenCompany\Integrations\Freshmarketer\Tools;

use OpenCompany\Integrations\Freshmarketer\FreshmarketerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FreshmarketerListCampaigns — list marketing campaigns with pagination and status filter.
 *
 * Calls POST /api/v1/campaigns with optional page, limit, and status parameters.
 */
class FreshmarketerListCampaigns implements Tool
{
    public function __construct(
        private FreshmarketerService $service,
    ) {}

    public function name(): string
    {
        return 'freshmarketer_list_campaigns';
    }

    public function description(): string
    {
        return 'List marketing campaigns from Freshmarketer. Supports pagination and filtering by status (e.g., "active", "completed", "draft").';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of campaigns per page (default: 20).'],
            'status' => ['type' => 'string', 'description' => 'Filter campaigns by status (e.g., "active", "completed", "draft").'],
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
            $status = $args['status'] ?? null;

            $result = $this->service->listCampaigns($page, $limit, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
