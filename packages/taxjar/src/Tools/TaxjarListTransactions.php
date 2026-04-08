<?php

namespace OpenCompany\Integrations\Taxjar\Tools;

use OpenCompany\Integrations\Taxjar\TaxjarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all transactions (orders and refunds) from TaxJar.
 *
 * Returns transaction details including transaction ID, amount, tax, date, and type.
 */
class TaxjarListTransactions implements Tool
{
    /**
     * Create a new TaxjarListTransactions tool instance.
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
        return 'taxjar_list_transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'List all transactions (orders and refunds) from TaxJar with optional date filtering and pagination. Returns transaction details including ID, amount, tax, date, and type.';
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
     * Execute the list transactions request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('TaxJar integration is not configured.');
            }

            $result = $this->service->listTransactions(
                fromDate: $args['from_date'] ?? null,
                toDate: $args['to_date'] ?? null,
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                offset: isset($args['offset']) ? (int) $args['offset'] : null,
            );

            $transactions = $result['transactions'] ?? [];

            return ToolResult::success([
                'transactions' => $transactions,
                'count' => count($transactions),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
