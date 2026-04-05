<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a QuickBooks estimate for a customer.
 *
 * Sends an estimate with customer reference and line items to the
 * QuickBooks estimate endpoint. Returns the created estimate with ID.
 */
class QuickBooksCreateEstimate implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_create_estimate';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a QuickBooks estimate for a customer.
        Provide customer_id and line_items (array of items with DetailType, Amount, and SalesItemLineDetail).
        Returns the created estimate with its ID and sync token.
        MD;
    }

    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks customer ID for the estimate.'],
            'line_items' => ['type' => 'object', 'required' => true, 'description' => 'Array of line items. Each item should include DetailType, Amount, and SalesItemLineDetail with ItemRef.'],
        ];
    }

    /**
     * Create a QuickBooks estimate.
     *
     * @param  array<string, mixed>  $args  Tool arguments (customer_id, line_items)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $customerId = $args['customer_id'] ?? '';
            if (empty($customerId)) {
                return ToolResult::error('customer_id is required.');
            }

            $lineItems = $args['line_items'] ?? [];
            if (empty($lineItems) || ! is_array($lineItems)) {
                return ToolResult::error('line_items is required and must be a non-empty array.');
            }

            $data = [
                'CustomerRef' => ['value' => $customerId],
                'Line' => $lineItems,
            ];

            $result = $this->service->createEstimate($data);
            $estimate = $result['Estimate'] ?? $result;

            return ToolResult::success([
                'id' => $estimate['Id'] ?? '',
                'sync_token' => $estimate['SyncToken'] ?? '',
                'doc_number' => $estimate['DocNumber'] ?? '',
                'customer_ref' => $estimate['CustomerRef'] ?? [],
                'total_amt' => $estimate['TotalAmt'] ?? 0,
                'txn_date' => $estimate['TxnDate'] ?? '',
                'status' => $estimate['EmailStatus'] ?? '',
                'line_items' => $estimate['Line'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
