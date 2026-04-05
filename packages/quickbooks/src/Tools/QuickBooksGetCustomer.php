<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a QuickBooks customer by ID.
 *
 * Returns full customer details including contact info, company name, and balance.
 */
class QuickBooksGetCustomer implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_get_customer';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a QuickBooks customer by ID.
        Returns full customer details including contact info, company name, and balance.
        MD;
    }

    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks customer ID.'],
        ];
    }

    /**
     * Retrieve a QuickBooks customer by ID with full details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (customer_id)
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

            $result = $this->service->getCustomer($customerId);
            $customer = $result['Customer'] ?? $result;

            return ToolResult::success([
                'id' => $customer['Id'] ?? '',
                'sync_token' => $customer['SyncToken'] ?? '0',
                'display_name' => $customer['DisplayName'] ?? '',
                'first_name' => $customer['GivenName'] ?? null,
                'last_name' => $customer['FamilyName'] ?? null,
                'company_name' => $customer['CompanyName'] ?? null,
                'email' => $customer['PrimaryEmailAddr']['Address'] ?? null,
                'phone' => $customer['PrimaryPhone']['FreeFormNumber'] ?? null,
                'balance' => $customer['Balance'] ?? 0,
                'active' => $customer['Active'] ?? true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
