<?php

namespace OpenCompany\Integrations\Lasso\Tools;

use OpenCompany\Integrations\Lasso\LassoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Deals.
 *
 * Lists deals (sales) in Lasso CRM with optional filtering and pagination.
 */
class LassoListDeals implements Tool
{
    /**
     * @param  LassoService  $service  The Lasso API service instance.
     */
    public function __construct(
        private LassoService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'lasso_list_deals';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List deals (sales) in Lasso CRM. Optionally filter by project ID or status. Supports pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'description' => 'Filter deals by project ID.'],
            'status'     => ['type' => 'string', 'description' => 'Filter by deal status.'],
            'limit'      => ['type' => 'integer', 'description' => 'Maximum number of deals to return (default: 25).'],
            'page'       => ['type' => 'integer', 'description' => 'Page number for pagination.'],
        ];
    }

    /**
     * Execute the list deals tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (project_id, status, limit, page).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Lasso CRM integration is not configured.');
            }

            $filters = [];
            if (isset($args['project_id'])) {
                $filters['project_id'] = $args['project_id'];
            }
            if (isset($args['status'])) {
                $filters['status'] = $args['status'];
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page  = isset($args['page']) ? (int) $args['page'] : null;

            $result = $this->service->listDeals($filters, $limit, $page);

            $deals = $result['data'] ?? [];
            $total = $result['total'] ?? count($deals);

            return ToolResult::success([
                'deals' => $deals,
                'count' => count($deals),
                'total' => $total,
                'page'  => $result['current_page'] ?? $page ?? 1,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
