<?php

namespace OpenCompany\Integrations\Square\Tools;

use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Square payments with optional filtering.
 *
 * Supports filtering by location, time range, and pagination with cursor.
 */
class SquareListPayments implements Tool
{
    /**
     * @param  SquareService  $service  The Square API client
     */
    public function __construct(
        private SquareService $service,
    ) {}

    public function name(): string
    {
        return 'square_list_payments';
    }

    public function description(): string
    {
        return <<<'MD'
        List Square payments with optional filtering.
        Supports filtering by location ID, begin_time / end_time (ISO 8601), and pagination with cursor.
        MD;
    }

    public function parameters(): array
    {
        return [
            'location_id' => ['type' => 'string', 'description' => 'Filter by location ID.'],
            'begin_time' => ['type' => 'string', 'description' => 'Start of time range (ISO 8601, e.g., "2024-01-01T00:00:00Z").'],
            'end_time' => ['type' => 'string', 'description' => 'End of time range (ISO 8601).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of payments to return (1–100, default 20).'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor for pagination — returned from a previous request.'],
        ];
    }

    /**
     * List Square payments with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Square integration is not configured.');
            }

            $params = [];

            if (isset($args['location_id'])) {
                $params['location_id'] = $args['location_id'];
            }
            if (isset($args['begin_time'])) {
                $params['begin_time'] = $args['begin_time'];
            }
            if (isset($args['end_time'])) {
                $params['end_time'] = $args['end_time'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }

            $result = $this->service->listPayments($params);

            $payments = array_map(function (array $p) {
                return [
                    'id' => $p['id'] ?? '',
                    'amount_money' => $p['amount_money'] ?? [],
                    'status' => $p['status'] ?? '',
                    'source_type' => $p['source_type'] ?? '',
                    'created_at' => $p['created_at'] ?? null,
                    'order_id' => $p['order_id'] ?? null,
                    'customer_id' => $p['customer_id'] ?? null,
                ];
            }, $result['payments'] ?? []);

            return ToolResult::success([
                'payments' => $payments,
                'cursor' => $result['cursor'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
