<?php

namespace OpenCompany\Integrations\Square\Tools;

use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Square orders for a location.
 *
 * Supports filtering by location, order states, and pagination with cursor.
 */
class SquareListOrders implements Tool
{
    /**
     * @param  SquareService  $service  The Square API client
     */
    public function __construct(
        private SquareService $service,
    ) {}

    public function name(): string
    {
        return 'square_list_orders';
    }

    public function description(): string
    {
        return <<<'MD'
        List Square orders for a specific location.
        Requires a location_id. Supports filtering by order states and pagination with cursor.
        MD;
    }

    public function parameters(): array
    {
        return [
            'location_id' => ['type' => 'string', 'required' => true, 'description' => 'Square location ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of orders to return (1–100, default 20).'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor for pagination — returned from a previous request.'],
            'states' => ['type' => 'array', 'description' => 'Filter by order states (OPEN, COMPLETED, CANCELED). Pass as a comma-separated string.'],
        ];
    }

    /**
     * List Square orders for a location with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Square integration is not configured.');
            }

            $locationId = $args['location_id'] ?? '';
            if (empty($locationId)) {
                return ToolResult::error('location_id is required.');
            }

            $params = ['location_id' => $locationId];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }
            if (isset($args['states'])) {
                $states = $args['states'];
                if (is_string($states)) {
                    $states = array_map('trim', explode(',', $states));
                }
                $params['states'] = $states;
            }

            $result = $this->service->listOrders($params);

            $orders = array_map(function (array $o) {
                return [
                    'id' => $o['id'] ?? '',
                    'location_id' => $o['location_id'] ?? '',
                    'state' => $o['state'] ?? '',
                    'total_money' => $o['total_money'] ?? null,
                    'total_tax_money' => $o['total_tax_money'] ?? null,
                    'total_discount_money' => $o['total_discount_money'] ?? null,
                    'created_at' => $o['created_at'] ?? null,
                    'updated_at' => $o['updated_at'] ?? null,
                ];
            }, $result['orders'] ?? []);

            return ToolResult::success([
                'orders' => $orders,
                'cursor' => $result['cursor'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
