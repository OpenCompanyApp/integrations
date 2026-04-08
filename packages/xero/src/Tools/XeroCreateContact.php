<?php

namespace OpenCompany\Integrations\Xero\Tools;

use OpenCompany\Integrations\Xero\XeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Xero contact (upsert via PUT).
 *
 * Creates a new contact or updates an existing one with the same name.
 * Supports name, email, phone, first name, and last name.
 */
class XeroCreateContact implements Tool
{
    /**
     * @param  XeroService  $service  The Xero API client
     */
    public function __construct(
        private XeroService $service,
    ) {}

    public function name(): string
    {
        return 'xero_create_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a Xero contact.
        Requires a name. Supports email, phone, first name, and last name.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Full name of the contact.'],
            'email' => ['type' => 'string', 'description' => 'Contact email address.'],
            'phone' => ['type' => 'string', 'description' => 'Contact phone number.'],
            'first_name' => ['type' => 'string', 'description' => 'First name of the contact person.'],
            'last_name' => ['type' => 'string', 'description' => 'Last name of the contact person.'],
        ];
    }

    /**
     * Create a Xero contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, email, phone, first_name, last_name)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Xero integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $contact = [
                'Name' => $name,
            ];

            if (! empty($args['email'])) {
                $contact['EmailAddress'] = $args['email'];
            }
            if (! empty($args['first_name'])) {
                $contact['FirstName'] = $args['first_name'];
            }
            if (! empty($args['last_name'])) {
                $contact['LastName'] = $args['last_name'];
            }

            // Build phone structure if provided
            if (! empty($args['phone'])) {
                $contact['Phones'] = [
                    [
                        'PhoneType' => 'DEFAULT',
                        'PhoneNumber' => $args['phone'],
                    ],
                ];
            }

            $result = $this->service->createContact(['Contacts' => [$contact]]);

            $created = $result['Contacts'][0] ?? [];

            return ToolResult::success([
                'id' => $created['ContactID'] ?? '',
                'name' => $created['Name'] ?? '',
                'email' => $created['EmailAddress'] ?? '',
                'first_name' => $created['FirstName'] ?? '',
                'last_name' => $created['LastName'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
