<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Xero contact (POST).
 *
 * Supports updating name, email, and phone on an existing contact.
 */
class XeroUpdateContact implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_update_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing Xero contact.
        Supports updating name, email, and phone number.
        MD;
    }

    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Xero contact GUID to update.'],
            'name' => ['type' => 'string', 'description' => 'Updated contact name.'],
            'email' => ['type' => 'string', 'description' => 'Updated email address.'],
            'phone' => ['type' => 'string', 'description' => 'Updated phone number.'],
        ];
    }

    /**
     * Update a Xero contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments (contact_id, name, email, phone)
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

            $contact = [];

            if (! empty($args['name'])) {
                $contact['Name'] = $args['name'];
            }
            if (! empty($args['email'])) {
                $contact['EmailAddress'] = $args['email'];
            }
            if (! empty($args['phone'])) {
                $contact['Phones'] = [
                    [
                        'PhoneType' => 'DEFAULT',
                        'PhoneNumber' => $args['phone'],
                    ],
                ];
            }

            if (empty($contact)) {
                return ToolResult::error('At least one of name, email, or phone must be provided.');
            }

            $result = $this->service->updateContact($contactId, ['Contacts' => [$contact]]);

            $updated = $result['Contacts'][0] ?? [];

            return ToolResult::success([
                'id' => $updated['ContactID'] ?? '',
                'name' => $updated['Name'] ?? '',
                'email' => $updated['EmailAddress'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
