<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a HubSpot company by ID.
 *
 * Returns the company's ID and all requested properties.
 */
class HubSpotGetCompany implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_get_company';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a HubSpot company by its ID.
        Returns the company's ID, properties, and associated data.
        Optionally specify which properties to include.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'HubSpot company ID.'],
            'properties' => ['type' => 'array', 'description' => 'List of property names to include.'],
        ];
    }

    /**
     * Retrieve a HubSpot company by ID with optional property selection.
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

            $properties = $args['properties'] ?? null;
            $result = $this->service->getCompany($id, is_array($properties) ? $properties : null);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'properties' => $result['properties'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
