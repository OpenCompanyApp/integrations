<?php

namespace OpenCompany\Integrations\Square\Tools;

use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Square order by ID.
 *
 * Returns full order details including line items, totals, taxes, and discounts.
 */
class SquareGetOrder implements Tool
{
    /**
     * @param  SquareService  $service  The Square API client
     */
    public function __construct(
        private SquareService $service,
    ) {}

    public function name(): string
    {
        return 'square_get_order';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Square order by ID.
        Returns full order details including line items, totals, taxes, and discounts.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Square order ID.'],
        ];
    }

    /**
     * Retrieve a Square order by ID with full details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Square integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->getOrder($id);
            $order = $result['order'] ?? [];

            return ToolResult::success([
                'id' => $order['id'] ?? '',
                'location_id' => $order['location_id'] ?? '',
                'state' => $order['state'] ?? '',
                'line_items' => $order['line_items'] ?? [],
                'total_money' => $order['total_money'] ?? null,
                'total_tax_money' => $order['total_tax_money'] ?? null,
                'total_discount_money' => $order['total_discount_money'] ?? null,
                'total_service_charge_money' => $order['total_service_charge_money'] ?? null,
                'tenders' => $order['tenders'] ?? [],
                'returns' => $order['returns'] ?? [],
                'customer_id' => $order['customer_id'] ?? null,
                'created_at' => $order['created_at'] ?? null,
                'updated_at' => $order['updated_at'] ?? null,
                'closed_at' => $order['closed_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
