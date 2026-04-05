<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new QuickBooks customer.
 *
 * Sends customer details including display name, name parts, email, and phone
 * to the QuickBooks customer endpoint. Returns the created customer with ID.
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
        Provide at minimum a display_name. Optionally include first_name, last_name, email, and phone.
        Returns the created customer with ID and sync token.
        MD;
    }

    public function parameters(): array
    {
        return [
            'display_name' => ['type' => 'string', 'required' => true, 'description' => 'Display name for the customer (must be unique).'],
            'first_name' => ['type' => 'string', 'description' => 'Customer first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Customer last name.'],
            'email' => ['type' => 'string', 'description' => 'Primary email address for the customer.'],
            'phone' => ['type' => 'string', 'description' => 'Primary phone number for the customer.'],
        ];
    }

    /**
     * Create a new QuickBooks customer.
     *
     * @param  array<string, mixed>  $args  Tool arguments (display_name, first_name, last_name, email, phone)
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

            if (! empty($args['first_name'])) {
                $data['GivenName'] = $args['first_name'];
            }
            if (! empty($args['last_name'])) {
                $data['FamilyName'] = $args['last_name'];
            }
            if (! empty($args['email'])) {
                $data['PrimaryEmailAddr'] = ['Address' => $args['email']];
            }
            if (! empty($args['phone'])) {
                $data['PrimaryPhone'] = ['FreeFormNumber' => $args['phone']];
            }

            $result = $this->service->createCustomer($data);
            $customer = $result['Customer'] ?? $result;

            return ToolResult::success([
                'id' => $customer['Id'] ?? '',
                'sync_token' => $customer['SyncToken'] ?? '',
                'display_name' => $customer['DisplayName'] ?? '',
                'first_name' => $customer['GivenName'] ?? '',
                'last_name' => $customer['FamilyName'] ?? '',
                'email' => $customer['PrimaryEmailAddr']['Address'] ?? '',
                'phone' => $customer['PrimaryPhone']['FreeFormNumber'] ?? '',
                'active' => $customer['Active'] ?? true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
