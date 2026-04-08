<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new contact in HubSpot CRM.
 *
 * Supports standard contact properties (firstname, lastname, email, phone, company) plus arbitrary custom properties.
 */
class HubSpotCreateContact implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_create_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new contact in HubSpot CRM.
        Supports firstname, lastname, email, phone, company, and any additional custom properties.
        Returns the created contact with its HubSpot ID and properties.
        MD;
    }

    public function parameters(): array
    {
        return [
            'first_name' => ['type' => 'string', 'description' => 'Contact first name.'],
            'last_name' => ['type' => 'string', 'description' => 'Contact last name.'],
            'email' => ['type' => 'string', 'description' => 'Contact email address.'],
            'phone' => ['type' => 'string', 'description' => 'Contact phone number.'],
            'company' => ['type' => 'string', 'description' => 'Contact company name.'],
            'properties' => ['type' => 'object', 'description' => 'Additional custom properties as key-value pairs.'],
        ];
    }

    /**
     * Create a new HubSpot contact with the provided details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (first_name, last_name, email, phone, company, properties)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $properties = [];

            if (! empty($args['first_name'])) {
                $properties['firstname'] = $args['first_name'];
            }
            if (! empty($args['last_name'])) {
                $properties['lastname'] = $args['last_name'];
            }
            if (! empty($args['email'])) {
                $properties['email'] = $args['email'];
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

            if (empty($properties)) {
                return ToolResult::error('At least one contact property is required.');
            }

            $result = $this->service->createContact($properties);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'properties' => $result['properties'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
