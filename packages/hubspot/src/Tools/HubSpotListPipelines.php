<?php

namespace OpenCompany\Integrations\HubSpot\Tools;

use OpenCompany\Integrations\HubSpot\HubSpotService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List HubSpot CRM pipelines for a given object type.
 *
 * Returns all pipelines and their stages for deals or tickets.
 */
class HubSpotListPipelines implements Tool
{
    /**
     * @param  HubSpotService  $service  The HubSpot API client
     */
    public function __construct(
        private HubSpotService $service,
    ) {}

    public function name(): string
    {
        return 'hubspot_list_pipelines';
    }

    public function description(): string
    {
        return <<<'MD'
        List HubSpot CRM pipelines for a given object type.
        Returns all pipelines and their stages. Commonly used for deals and tickets.
        Use the object type "deals" or "tickets" to get the respective pipelines.
        MD;
    }

    public function parameters(): array
    {
        return [
            'object_type' => ['type' => 'string', 'required' => true, 'description' => 'Object type (e.g., "deals", "tickets").'],
        ];
    }

    /**
     * List HubSpot CRM pipelines for the specified object type.
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

            $result = $this->service->listPipelines($objectType);

            $pipelines = array_map(function (array $pipeline): array {
                $stages = array_map(function (array $stage): array {
                    return [
                        'id' => $stage['id'] ?? '',
                        'label' => $stage['label'] ?? '',
                        'display_order' => $stage['displayOrder'] ?? 0,
                    ];
                }, $pipeline['stages'] ?? []);

                return [
                    'id' => $pipeline['id'] ?? '',
                    'label' => $pipeline['label'] ?? '',
                    'display_order' => $pipeline['displayOrder'] ?? 0,
                    'stages' => $stages,
                ];
            }, $result['results'] ?? []);

            return ToolResult::success([
                'object_type' => $objectType,
                'results' => $pipelines,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
