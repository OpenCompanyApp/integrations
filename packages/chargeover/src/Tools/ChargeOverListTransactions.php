<?php

namespace OpenCompany\Integrations\ChargeOver\Tools;

use OpenCompany\Integrations\ChargeOver\ChargeOverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List ChargeOver payment, refund, and credit transactions.
 */
class ChargeOverListTransactions implements Tool
{
    /**
     * @param  ChargeOverService  $service  The ChargeOver API client.
     */
    public function __construct(
        private ChargeOverService $service,
    ) {}

    public function name(): string
    {
        return 'chargeover_list_transactions';
    }

    public function description(): string
    {
        return 'List transactions from ChargeOver, including payments, refunds, and credits. Supports limit/offset pagination, where filters, sorting, and applied_to expansion.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of transactions to return per page (default: 10, max: 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Record offset for pagination (default: 0).'],
            'where' => ['type' => 'string', 'description' => 'ChargeOver where expression, e.g. transaction_status.state:EQUALS:succeeded.'],
            'order' => ['type' => 'string', 'description' => 'Sort expression, e.g. transaction_id:DESC.'],
            'expand' => ['type' => 'string', 'description' => 'Optional expansion such as applied_to.'],
        ];
    }

    /**
     * List transactions through the ChargeOver API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, offset, where, order, expand).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChargeOver integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listTransactions(
                $limit,
                $offset,
                $args['where'] ?? null,
                $args['order'] ?? null,
                $args['expand'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
