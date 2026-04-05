<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or update a HubSpot contact by email.
 *
 * Searches for an existing contact by email; creates one if not found, updates if found.
 */
class HubSpotCreateOrUpdateContact implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_create_or_update_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Create or update a HubSpot contact by email.
        First searches for an existing contact matching the email. If found, updates it. If not found, creates a new contact.
        Supports firstname, lastname, phone, company, and any additional custom properties.
        MD;
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Contact email address used for lookup.'],
            'first_name' => ['type' => 'string', 'description' => 'Contact first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Contact last name.'],
            'phone' => ['type' => 'string', 'description' => 'Contact phone number.'],
            'company' => ['type' => 'string', 'description' => 'Contact company name.'],
            'properties' => ['type' => 'object', 'description' => 'Additional custom properties as key-value pairs.'],
        ];
    }

    /**
     * Create or update a HubSpot contact, matching by email.
     *
     * @param  array<string, mixed>  $args  Tool arguments (email, first_name, last_name, phone, company, properties)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('email is required.');
            }

            $properties = [];

            if (! empty($args['first_name'])) {
                $properties['firstname'] = $args['first_name'];
            }
            if (! empty($args['last_name'])) {
                $properties['lastname'] = $args['last_name'];
            }
            if (! empty($email)) {
                $properties['email'] = $email;
            }
            if (! empty($args['phone'])) {
                $properties['phone'] = $args['phone'];
            }
            if (! empty($args['company'])) {
                $properties['company'] = $args['company'];
            }

            if (isset($args['properties']) && is_array($args['properties'])) {
                foreach ($args['properties'] as $key => $value) {
                    $properties[$key] = $value;
                }
            }

            // Search for existing contact by email
            $search = $this->service->searchContacts([
                'filterGroups' => [
                    [
                        'filters' => [
                            [
                                'propertyName' => 'email',
                                'operator' => 'EQ',
                                'value' => $email,
                            ],
                        ],
                    ],
                ],
                'properties' => ['email'],
                'limit' => 1,
            ]);

            $existing = $search['results'][0] ?? null;

            if ($existing !== null) {
                // Update existing contact
                $result = $this->service->updateContact($existing['id'], $properties);

                return ToolResult::success([
                    'id' => $result['id'] ?? $existing['id'],
                    'properties' => $result['properties'] ?? [],
                    'action' => 'updated',
                ]);
            }

            // Create new contact
            $result = $this->service->createContact($properties);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'properties' => $result['properties'] ?? [],
                'action' => 'created',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
