<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new QuickBooks customer.
 *
 * Supports display name, first/last name, email, phone, and company name.
 */
class QuickBooksCreateCustomer implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_create_customer';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new QuickBooks customer.
        Supports display name, first/last name, email, phone, and company name.
        MD;
    }

    public function parameters(): array
    {
        return [
            'display_name' => ['type' => 'string', 'required' => true, 'description' => 'Display name for the customer (must be unique).'],
            'first_name' => ['type' => 'string', 'description' => 'Customer first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Customer last name.'],
            'email' => ['type' => 'string', 'description' => 'Primary email address.'],
            'phone' => ['type' => 'string', 'description' => 'Primary phone number.'],
            'company_name' => ['type' => 'string', 'description' => 'Company name for a business customer.'],
        ];
    }

    /**
     * Create a new QuickBooks customer with contact details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (display_name, first_name, last_name, email, phone, company_name)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $displayName = $args['display_name'] ?? '';
            if (empty($displayName)) {
                return ToolResult::error('display_name is required.');
            }

            $data = [
                'DisplayName' => $displayName,
            ];

            if (isset($args['first_name'])) {
                $data['GivenName'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $data['FamilyName'] = $args['last_name'];
            }
            if (isset($args['company_name'])) {
                $data['CompanyName'] = $args['company_name'];
            }
            if (isset($args['phone'])) {
                $data['PrimaryPhone'] = ['FreeFormNumber' => $args['phone']];
            }
            if (isset($args['email'])) {
                $data['PrimaryEmailAddr'] = ['Address' => $args['email']];
            }

            $result = $this->service->createCustomer($data);
            $customer = $result['Customer'] ?? $result;

            return ToolResult::success([
                'id' => $customer['Id'] ?? '',
                'sync_token' => $customer['SyncToken'] ?? '0',
                'display_name' => $customer['DisplayName'] ?? $displayName,
                'company_name' => $customer['CompanyName'] ?? null,
                'email' => $customer['PrimaryEmailAddr']['Address'] ?? null,
                'phone' => $customer['PrimaryPhone']['FreeFormNumber'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
