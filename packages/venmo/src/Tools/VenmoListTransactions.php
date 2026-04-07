<?php

namespace OpenCompany\Integrations\Venmo\Tools;

use OpenCompany\Integrations\Venmo\VenmoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Venmo transactions with optional filtering.
 *
 * Supports filtering by date range, action type, and pagination.
 */
class VenmoListTransactions implements Tool
{
    /**
     * @param  VenmoService  $service  The Venmo API client
     */
    public function __construct(
        private VenmoService $service,
    ) {}

    public function name(): string
    {
        return 'venmo_list_transactions';
    }

    public function description(): string
    {
        return <<<'MD'
        List Venmo transactions with optional filtering.
        Supports filtering by date range, action type, and pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of transactions to return (default 20).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
            'after' => ['type' => 'string', 'description' => 'Only return transactions after this timestamp (ISO 8601).'],
            'before' => ['type' => 'string', 'description' => 'Only return transactions before this timestamp (ISO 8601).'],
            'action' => ['type' => 'string', 'description' => 'Filter by action type: "pay" or "charge".'],
        ];
    }

    /**
     * List Venmo transactions with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset, after, before, action)
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
            if (isset($args['action'])) {
                $params['action'] = $args['action'];
            }

            $result = $this->service->listTransactions($params);

            $transactions = array_map(function (array $t) {
                return [
                    'id' => $t['id'] ?? '',
                    'status' => $t['status'] ?? '',
                    'amount' => $t['amount'] ?? 0,
                    'note' => $t['note'] ?? '',
                    'action' => $t['action'] ?? '',
                    'created_at' => $t['created_at'] ?? null,
                    'updated_at' => $t['updated_at'] ?? null,
                ];
            }, $result['data'] ?? []);

            return ToolResult::success([
                'transactions' => $transactions,
                'paging' => $result['paging'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
