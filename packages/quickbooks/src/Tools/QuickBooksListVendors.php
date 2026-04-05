<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List QuickBooks vendors using a SQL-like query.
 *
 * Supports pagination via limit. Returns an array of vendor summaries.
 */
class QuickBooksListVendors implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_list_vendors';
    }

    public function description(): string
    {
        return <<<'MD'
        List QuickBooks vendors using a SQL-like query.
        Supports pagination via limit. Returns vendor summaries.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of vendors to return (1–1000, default 100).'],
        ];
    }

    /**
     * List QuickBooks vendors with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;

            $query = "SELECT * FROM Vendor MAXRESULTS {$limit}";

            $result = $this->service->query($query);
            $queryResponse = $result['QueryResponse'] ?? [];
            $vendors = $queryResponse['Vendor'] ?? [];

            $mapped = array_map(function (array $v) {
                return [
                    'id' => $v['Id'] ?? '',
                    'sync_token' => $v['SyncToken'] ?? '0',
                    'display_name' => $v['DisplayName'] ?? '',
                    'company_name' => $v['CompanyName'] ?? null,
                    'email' => $v['PrimaryEmailAddr']['Address'] ?? null,
                    'phone' => $v['PrimaryPhone']['FreeFormNumber'] ?? null,
                    'balance' => $v['Balance'] ?? 0,
                    'active' => $v['Active'] ?? true,
                ];
            }, $vendors);

            return ToolResult::success([
                'vendors' => $mapped,
                'total_count' => $queryResponse['totalCount'] ?? count($mapped),
                'max_results' => $queryResponse['maxResults'] ?? $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
