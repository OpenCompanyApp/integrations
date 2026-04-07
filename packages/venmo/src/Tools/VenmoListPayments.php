<?php

namespace OpenCompany\Integrations\Venmo\Tools;

use OpenCompany\Integrations\Venmo\VenmoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Venmo payments with optional filtering.
 *
 * Supports pagination with limit and offset parameters.
 */
class VenmoListPayments implements Tool
{
    /**
     * @param  VenmoService  $service  The Venmo API client
     */
    public function __construct(
        private VenmoService $service,
    ) {}

    public function name(): string
    {
        return 'venmo_list_payments';
    }

    public function description(): string
    {
        return <<<'MD'
        List Venmo payments with optional filtering.
        Supports pagination with limit and offset parameters.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of payments to return (default 20).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
            'after' => ['type' => 'string', 'description' => 'Only return payments after this timestamp (ISO 8601).'],
            'before' => ['type' => 'string', 'description' => 'Only return payments before this timestamp (ISO 8601).'],
        ];
    }

    /**
     * List Venmo payments with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset, after, before)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Venmo integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['after'])) {
                $params['after'] = $args['after'];
            }
            if (isset($args['before'])) {
                $params['before'] = $args['before'];
            }

            $result = $this->service->listPayments($params);

            $payments = array_map(function (array $p) {
                return [
                    'id' => $p['id'] ?? '',
                    'status' => $p['status'] ?? '',
                    'amount' => $p['amount'] ?? 0,
                    'note' => $p['note'] ?? '',
                    'action' => $p['action'] ?? '',
                    'created_at' => $p['created_at'] ?? null,
                    'updated_at' => $p['updated_at'] ?? null,
                ];
            }, $result['data'] ?? []);

            return ToolResult::success([
                'payments' => $payments,
                'paging' => $result['paging'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
