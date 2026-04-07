<?php

namespace OpenCompany\Integrations\Taxjar\Tools;

use OpenCompany\Integrations\Taxjar\TaxjarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list order transactions from TaxJar with optional filtering and pagination.
 *
 * Returns order details including transaction ID, amount, tax, and date.
 */
class TaxjarListOrders implements Tool
{
    /**
     * Create a new TaxjarListOrders tool instance.
     *
     * @param  TaxjarService  $service  The TaxJar API service.
     */
    public function __construct(
        private TaxjarService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'taxjar_list_orders';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'List order transactions from TaxJar with optional date filtering and pagination. Returns order details including transaction ID, amount, tax, and date.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'from_date' => ['type' => 'string', 'description' => 'Filter by start date (ISO 8601 format, e.g. 2024-01-01).'],
            'to_date' => ['type' => 'string', 'description' => 'Filter by end date (ISO 8601 format, e.g. 2024-12-31).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page.'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
        ];
    }

    /**
     * Execute the list orders request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('TaxJar integration is not configured.');
            }

            $result = $this->service->listOrders(
                fromDate: $args['from_date'] ?? null,
                toDate: $args['to_date'] ?? null,
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                offset: isset($args['offset']) ? (int) $args['offset'] : null,
            );

            $orders = $result['orders'] ?? [];

            return ToolResult::success([
                'orders' => $orders,
                'count' => count($orders),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
