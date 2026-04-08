<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Xero contact by ID.
 *
 * Returns the contact's ID, name, email, phone, and addresses.
 */
class XeroGetContact implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_get_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Xero contact by its ID.
        Returns the contact's ID, name, email, phone, addresses, and status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Xero contact ID (UUID).'],
        ];
    }

    /**
     * Retrieve a Xero contact by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (contact_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $id = $args['contact_id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('contact_id is required.');
            }

            $result = $this->service->getContact($id);

            $contact = $result['Contacts'][0] ?? $result;

            return ToolResult::success([
                'id' => $contact['ContactID'] ?? '',
                'name' => $contact['Name'] ?? '',
                'first_name' => $contact['FirstName'] ?? '',
                'last_name' => $contact['LastName'] ?? '',
                'email' => $contact['EmailAddress'] ?? '',
                'status' => $contact['ContactStatus'] ?? '',
                'is_supplier' => $contact['IsSupplier'] ?? false,
                'is_customer' => $contact['IsCustomer'] ?? true,
                'addresses' => $contact['Addresses'] ?? [],
                'phones' => $contact['Phones'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
