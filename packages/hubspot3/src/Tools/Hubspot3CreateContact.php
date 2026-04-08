<?php

namespace OpenCompany\Integrations\Hubspot3\Tools;

use OpenCompany\Integrations\Hubspot3\Hubspot3Service;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new HubSpot contact.
 *
 * Creates a contact with the provided email, name, and optional properties.
 */
class Hubspot3CreateContact implements Tool
{
    /**
     * @param  Hubspot3Service  $service  The HubSpot API client
     */
    public function __construct(
        private Hubspot3Service $service,
    ) {}

    public function name(): string
    {
        return 'hubspot3_create_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new HubSpot contact.
        Requires an email address. Optionally set first name, last name, phone, company, and other properties.
        Returns the created contact with its ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Contact email address.'],
            'first_name' => ['type' => 'string', 'description' => 'Contact first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Contact last name.'],
            'phone' => ['type' => 'string', 'description' => 'Contact phone number.'],
            'company' => ['type' => 'string', 'description' => 'Contact company name.'],
            'properties' => ['type' => 'object', 'description' => 'Additional custom properties as key-value pairs.'],
        ];
    }

    /**
     * Create a new HubSpot contact.
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

            $properties = [
                ['property' => 'email', 'value' => $email],
            ];

            $optionalFields = [
                'first_name' => 'firstname',
                'last_name' => 'lastname',
                'phone' => 'phone',
                'company' => 'company',
            ];

            foreach ($optionalFields as $argKey => $hubspotKey) {
                if (isset($args[$argKey]) && $args[$argKey] !== '') {
                    $properties[] = ['property' => $hubspotKey, 'value' => $args[$argKey]];
                }
            }

            // Additional custom properties
            if (isset($args['properties']) && is_array($args['properties'])) {
                foreach ($args['properties'] as $key => $value) {
                    $properties[] = ['property' => $key, 'value' => $value];
                }
            }

            $result = $this->service->createContact(['properties' => $properties]);

            return ToolResult::success([
                'id' => $result['vid'] ?? $result['id'] ?? '',
                'email' => $email,
                'isNew' => $result['isNew'] ?? true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
