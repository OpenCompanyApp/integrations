<?php

namespace OpenCompany\Integrations\QuickBooks\Tools;

use OpenCompany\Integrations\QuickBooks\QuickBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing QuickBooks customer.
 *
 * Requires the customer ID and sync token for optimistic concurrency.
 * Supports updating display name, email, and phone.
 */
class QuickBooksUpdateCustomer implements Tool
{
    /**
     * @param  QuickBooksService  $service  The QuickBooks API client
     */
    public function __construct(
        private QuickBooksService $service,
    ) {}

    public function name(): string
    {
        return 'quickbooks_update_customer';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing QuickBooks customer.
        Requires the customer ID and sync token for optimistic concurrency.
        Supports updating display name, email, and phone.
        MD;
    }

    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'QuickBooks customer ID to update.'],
            'sync_token' => ['type' => 'string', 'required' => true, 'description' => 'Current sync token for optimistic concurrency.'],
            'display_name' => ['type' => 'string', 'description' => 'Updated display name.'],
            'email' => ['type' => 'string', 'description' => 'Updated primary email address.'],
            'phone' => ['type' => 'string', 'description' => 'Updated primary phone number.'],
        ];
    }

    /**
     * Update an existing QuickBooks customer's details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (customer_id, sync_token, display_name, email, phone)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('QuickBooks integration is not configured.');
            }

            $customerId = $args['customer_id'] ?? '';
            $syncToken = $args['sync_token'] ?? '';

            if (empty($customerId)) {
                return ToolResult::error('customer_id is required.');
            }
            if ($syncToken === '') {
                return ToolResult::error('sync_token is required for optimistic concurrency.');
            }

            $data = [
                'Id' => $customerId,
                'SyncToken' => $syncToken,
            ];

            if (isset($args['display_name'])) {
                $data['DisplayName'] = $args['display_name'];
            }
            if (isset($args['email'])) {
                $data['PrimaryEmailAddr'] = ['Address' => $args['email']];
            }
            if (isset($args['phone'])) {
                $data['PrimaryPhone'] = ['FreeFormNumber' => $args['phone']];
            }

            $result = $this->service->updateCustomer($data);
            $customer = $result['Customer'] ?? $result;

            return ToolResult::success([
                'id' => $customer['Id'] ?? '',
                'sync_token' => $customer['SyncToken'] ?? '',
                'display_name' => $customer['DisplayName'] ?? null,
                'email' => $customer['PrimaryEmailAddr']['Address'] ?? null,
                'phone' => $customer['PrimaryPhone']['FreeFormNumber'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
