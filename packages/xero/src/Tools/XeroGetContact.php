<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single Xero contact by ID.
 *
 * Returns full contact details including email, phone, and addresses.
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
        Retrieve a single Xero contact by ID.
        Returns full contact details including email, phone, and addresses.
        MD;
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Xero contact GUID.'],
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

            $contactId = $args['contact_id'] ?? '';
            if (empty($contactId)) {
                return ToolResult::error('contact_id is required.');
            }

            $result = $this->service->getContact($contactId);
            $contact = $result['Contacts'][0] ?? [];

            return ToolResult::success([
                'id' => $contact['ContactID'] ?? '',
                'name' => $contact['Name'] ?? '',
                'email' => $contact['EmailAddress'] ?? '',
                'first_name' => $contact['FirstName'] ?? '',
                'last_name' => $contact['LastName'] ?? '',
                'status' => $contact['ContactStatus'] ?? '',
                'is_supplier' => $contact['IsSupplier'] ?? false,
                'is_customer' => $contact['IsCustomer'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
