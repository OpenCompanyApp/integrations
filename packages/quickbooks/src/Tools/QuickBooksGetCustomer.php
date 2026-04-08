<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a QuickBooks customer by ID.
 */
class QuickBooksGetCustomer implements Tool
{
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_get_customer';
    }

    public function description(): string
    {
        return 'Retrieve a QuickBooks customer by ID. Returns full customer details including name, email, phone, and balance.';
    }

    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks customer ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
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
                'sync_token' => $customer['SyncToken'] ?? '',
                'display_name' => $customer['DisplayName'] ?? '',
                'first_name' => $customer['GivenName'] ?? '',
                'last_name' => $customer['FamilyName'] ?? '',
                'fully_qualified_name' => $customer['FullyQualifiedName'] ?? '',
                'email' => $customer['PrimaryEmailAddr']['Address'] ?? '',
                'phone' => $customer['PrimaryPhone']['FreeFormNumber'] ?? '',
                'balance' => $customer['Balance'] ?? 0,
                'active' => $customer['Active'] ?? true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
