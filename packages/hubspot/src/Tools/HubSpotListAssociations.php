<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List associations from a HubSpot CRM object to another object type.
 *
 * Returns all associations of the specified type from a source object.
 */
class HubSpotListAssociations implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_list_associations';
    }

    public function description(): string
    {
        return <<<'MD'
        List associations from a HubSpot CRM object to another object type.
        For example, list all companies associated with a specific contact.
        Returns the associated object IDs and association types.
        MD;
    }

    public function parameters(): array
    {
        return [
            'from_type' => ['type' => 'string', 'required' => true, 'description' => 'Source object type (e.g., "contacts", "companies", "deals").'],
            'from_id' => ['type' => 'string', 'required' => true, 'description' => 'Source object ID.'],
            'to_type' => ['type' => 'string', 'required' => true, 'description' => 'Target object type to list associations for (e.g., "companies", "contacts").'],
        ];
    }

    /**
     * List associations from a HubSpot CRM object to another object type.
     *
     * @param  array<string, mixed>  $args  Tool arguments (from_type, from_id, to_type)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('HubSpot integration is not configured.');
            }

            $fromType = $args['from_type'] ?? '';
            $fromId = $args['from_id'] ?? '';
            $toType = $args['to_type'] ?? '';

            if (empty($fromType) || empty($fromId) || empty($toType)) {
                return ToolResult::error('from_type, from_id, and to_type are all required.');
            }

            $result = $this->service->listAssociations($fromType, $fromId, $toType);

            $associations = array_map(function (array $assoc): array {
                return [
                    'id' => $assoc['id'] ?? '',
                    'type' => $assoc['type'] ?? '',
                ];
            }, $result['results'] ?? []);

            return ToolResult::success([
                'from_type' => $fromType,
                'from_id' => $fromId,
                'to_type' => $toType,
                'results' => $associations,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
