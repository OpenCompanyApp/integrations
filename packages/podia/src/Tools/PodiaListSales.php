<?php

namespace OpenCompany\Integrations\Podia\Tools;

use OpenCompany\Integrations\Podia\PodiaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PodiaListSales implements Tool
{
    public function __construct(
        private PodiaService $service,
    ) {}

    public function name(): string
    {
        return 'podia_list_sales';
    }

    public function description(): string
    {
        return 'List sales from your Podia account. Optionally filter by product ID, date range, or page. Returns sale details including buyer info, amount, and product.';
    }

    public function parameters(): array
    {
        return [
            'product_id' => ['type' => 'string', 'description' => 'Filter sales by a specific product ID.'],
            'before' => ['type' => 'string', 'description' => 'Only return sales before this ISO 8601 timestamp (e.g., "2026-01-01T00:00:00Z").'],
            'after' => ['type' => 'string', 'description' => 'Only return sales after this ISO 8601 timestamp (e.g., "2026-01-01T00:00:00Z").'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Podia integration is not configured.');
            }

            $params = [];
            if (!empty($args['product_id'])) {
                $params['product_id'] = $args['product_id'];
            }
            if (!empty($args['before'])) {
                $params['before'] = $args['before'];
            }
            if (!empty($args['after'])) {
                $params['after'] = $args['after'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listSales($params);

            $sales = $result['sales'] ?? [];

            return ToolResult::success([
                'sales' => $sales,
                'totalCount' => count($sales),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
