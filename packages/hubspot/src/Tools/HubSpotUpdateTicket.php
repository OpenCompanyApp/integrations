<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing HubSpot ticket.
 *
 * Accepts a properties map of fields to update on the ticket.
 */
class HubSpotUpdateTicket implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_update_ticket';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing HubSpot ticket by ID.
        Provide a properties object with the fields to update (e.g., {"subject": "New subject", "hs_pipeline_stage": "2"}).
        Returns the updated ticket.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'HubSpot ticket ID to update.'],
            'properties' => ['type' => 'object', 'required' => true, 'description' => 'Key-value map of properties to update.'],
        ];
    }

    /**
     * Update a HubSpot ticket with new property values.
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

            $result = $this->service->updateTicket($id, $properties);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'properties' => $result['properties'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
