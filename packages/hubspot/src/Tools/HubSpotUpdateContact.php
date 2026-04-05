<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing HubSpot contact.
 *
 * Accepts a properties map of fields to update on the contact.
 */
class HubSpotUpdateContact implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_update_contact';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing HubSpot contact by ID.
        Provide a properties object with the fields to update (e.g., {"firstname": "Jane", "phone": "555-0100"}).
        Returns the updated contact.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'HubSpot contact ID to update.'],
            'properties' => ['type' => 'object', 'required' => true, 'description' => 'Key-value map of properties to update (e.g., {"firstname": "Jane"}).'],
        ];
    }

    /**
     * Update a HubSpot contact with new property values.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, properties)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $properties = $args['properties'] ?? [];
            if (! is_array($properties) || empty($properties)) {
                return ToolResult::error('properties must be a non-empty object.');
            }

            $result = $this->service->updateContact($id, $properties);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'properties' => $result['properties'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
