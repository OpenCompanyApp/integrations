<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List QuickBooks customers using a SQL-like query.
 *
 * Supports pagination via limit and start_position. Returns an array of customer summaries.
 */
class QuickBooksListCustomers implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_list_customers';
    }

    public function description(): string
    {
        return <<<'MD'
        List QuickBooks customers using a SQL-like query.
        Supports pagination via limit and start_position. Returns customer summaries.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of customers to return (1–1000, default 100).'],
            'start_position' => ['type' => 'integer', 'description' => '1-based offset for pagination (default 1).'],
        ];
    }

    /**
     * List QuickBooks customers with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, start_position)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $startPosition = isset($args['start_position']) ? (int) $args['start_position'] : 1;

            $query = "SELECT * FROM Customer STARTPOSITION {$startPosition} MAXRESULTS {$limit}";

            $result = $this->service->query($query);
            $queryResponse = $result['QueryResponse'] ?? [];
            $customers = $queryResponse['Customer'] ?? [];

            $mapped = array_map(function (array $c) {
                return [
                    'id' => $c['Id'] ?? '',
                    'sync_token' => $c['SyncToken'] ?? '0',
                    'display_name' => $c['DisplayName'] ?? '',
                    'company_name' => $c['CompanyName'] ?? null,
                    'email' => $c['PrimaryEmailAddr']['Address'] ?? null,
                    'phone' => $c['PrimaryPhone']['FreeFormNumber'] ?? null,
                    'balance' => $c['Balance'] ?? 0,
                    'active' => $c['Active'] ?? true,
                ];
            }, $customers);

            return ToolResult::success([
                'customers' => $mapped,
                'total_count' => $queryResponse['totalCount'] ?? count($mapped),
                'start_position' => $queryResponse['startPosition'] ?? $startPosition,
                'max_results' => $queryResponse['maxResults'] ?? $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
