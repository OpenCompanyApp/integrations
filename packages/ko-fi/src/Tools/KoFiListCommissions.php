<?php

namespace OpenCompany\Integrations\KoFi\Tools;

use OpenCompany\Integrations\KoFi\KoFiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KoFiListCommissions implements Tool
{
    public function __construct(
        private KoFiService $service,
    ) {}

    public function name(): string
    {
        return 'ko-fi_list_commissions';
    }

    public function description(): string
    {
        return 'List all commission requests on your Ko-fi page. Returns commission details including status, requester info, and pricing.';
    }

    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'required' => false, 'description' => 'Filter by commission status: pending, accepted, completed, or declined.'],
            'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Number of results per page (default: 25).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ko-fi integration is not configured.');
            }

            $params = array_filter([
                'status' => $args['status'] ?? null,
                'page' => $args['page'] ?? null,
                'limit' => $args['limit'] ?? null,
            ], fn($v) => $v !== null);

            $result = $this->service->listCommissions($params);

            $commissions = $result['commissions'] ?? $result['data'] ?? [];

            return ToolResult::success([
                'commissions' => $commissions,
                'totalCount' => count($commissions),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
