<?php

namespace OpenCompany\Integrations\GoogleContacts\Tools;

use OpenCompany\Integrations\GoogleContacts\GoogleContactsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new contact in the authenticated user's Google Contacts.
 *
 * Creates a contact in the "myContacts" system group with the provided
 * names, email addresses, phone numbers, and biographies.
 *
 * @see https://developers.google.com/people/api/rest/v1/people/createContact
 */
class GoogleContactsCreateContact implements Tool
{
    public function __construct(
        private GoogleContactsService $service,
    ) {}

    public function name(): string
    {
        return 'google_contacts_create_contact';
    }

    public function description(): string
    {
        return 'Create a new contact in Google Contacts. Provide at least a name. You can also add email addresses, phone numbers, and a biography (notes).';
    }

    public function parameters(): array
    {
        return [
            'givenName' => ['type' => 'string', 'description' => 'Given (first) name of the contact.'],
            'familyName' => ['type' => 'string', 'description' => 'Family (last) name of the contact.'],
            'emailAddresses' => ['type' => 'array', 'description' => 'Email addresses. Each entry is a string (e.g., ["john@example.com"]).'],
            'phoneNumbers' => ['type' => 'array', 'description' => 'Phone numbers. Each entry is a string (e.g., ["+1234567890"]).'],
            'biography' => ['type' => 'string', 'description' => 'Notes or biography text for the contact.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Contacts integration is not configured.');
            }

            // Build names array
            $names = [];
            $givenName = $args['givenName'] ?? null;
            $familyName = $args['familyName'] ?? null;

            if ($givenName !== null || $familyName !== null) {
                $name = [];
                if ($givenName !== null) {
                    $name['givenName'] = $givenName;
                }
                if ($familyName !== null) {
                    $name['familyName'] = $familyName;
                }
                $names[] = $name;
            }

            if (empty($names)) {
                return ToolResult::error('At least a given name or family name is required to create a contact.');
            }

            // Build email addresses
            $emailAddresses = [];
            foreach ($args['emailAddresses'] ?? [] as $email) {
                if (is_string($email) && $email !== '') {
                    $emailAddresses[] = ['value' => $email];
                }
            }

            // Build phone numbers
            $phoneNumbers = [];
            foreach ($args['phoneNumbers'] ?? [] as $phone) {
                if (is_string($phone) && $phone !== '') {
                    $phoneNumbers[] = ['value' => $phone];
                }
            }

            // Build biographies
            $biographies = [];
            $biography = $args['biography'] ?? null;
            if ($biography !== null && $biography !== '') {
                $biographies[] = ['value' => $biography];
            }

            $result = $this->service->createContact($names, $emailAddresses, $phoneNumbers, $biographies);

            $displayName = $result['names'][0]['displayName'] ?? 'Unknown';
            $resourceName = $result['resourceName'] ?? 'unknown';

            return ToolResult::success([
                'message' => "Contact '{$displayName}' created successfully.",
                'resourceName' => $resourceName,
                'displayName' => $displayName,
                'emailAddresses' => array_map(fn (array $e) => $e['value'] ?? null, $result['emailAddresses'] ?? []),
                'phoneNumbers' => array_map(fn (array $p) => $p['value'] ?? null, $result['phoneNumbers'] ?? []),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
