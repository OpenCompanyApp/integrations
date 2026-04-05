<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List HubSpot CRM property definitions for a given object type.
 *
 * Returns all property definitions including name, label, type, and field type.
 */
class HubSpotListProperties implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_list_properties';
    }

    public function description(): string
    {
        return <<<'MD'
        List HubSpot CRM property definitions for a given object type.
        Returns all properties including their name, label, type, and field type.
        Useful for discovering available properties for contacts, companies, deals, or tickets.
        MD;
    }

    public function parameters(): array
    {
        return [
            'object_type' => ['type' => 'string', 'required' => true, 'description' => 'Object type (e.g., "contacts", "companies", "deals", "tickets").'],
        ];
    }

    /**
     * List HubSpot CRM property definitions for the specified object type.
     *
     * @param  array<string, mixed>  $args  Tool arguments (object_type)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $objectType = $args['object_type'] ?? '';
            if (empty($objectType)) {
                return ToolResult::error('object_type is required.');
            }

            $result = $this->service->listProperties($objectType);

            $properties = array_map(function (array $prop): array {
                return [
                    'name' => $prop['name'] ?? '',
                    'label' => $prop['label'] ?? '',
                    'type' => $prop['type'] ?? '',
                    'field_type' => $prop['fieldType'] ?? '',
                    'description' => $prop['description'] ?? '',
                    'options' => $prop['options'] ?? [],
                ];
            }, $result['results'] ?? []);

            return ToolResult::success([
                'object_type' => $objectType,
                'results' => $properties,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
