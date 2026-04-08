<?php

namespace OpenCompany\Integrations\Radar\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolResult;
use OpenCompany\Integrations\Radar\RadarService;

class RadarCreateGeofence implements Tool
{
    public function __construct(private RadarService $service) {}

    public function name(): string
    {
        return 'radar_create_geofence';
    }

    public function description(): string
    {
        return 'Create a new geofence in Radar with a name, type, and geometry.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the geofence.'],
            'description' => ['type' => 'string', 'description' => 'A description of the geofence.'],
            'type' => ['type' => 'string', 'description' => 'The geofence type, e.g. "circle", "polygon", or "isochrone".'],
            'coordinates' => ['type' => 'string', 'description' => 'GeoJSON coordinates or a center point (e.g. "lat,lng").'],
            'radius' => ['type' => 'integer', 'description' => 'Radius in meters (for circle geofences).'],
            'tag' => ['type' => 'string', 'description' => 'A tag to categorize the geofence.'],
            'group' => ['type' => 'string', 'description' => 'A group identifier for the geofence.'],
            'external_id' => ['type' => 'string', 'description' => 'An optional external ID for mapping to your own records.'],
            'metadata' => ['type' => 'object', 'description' => 'Optional custom metadata key-value pairs.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Radar integration is not configured.');
            }

            $data = [];
            $dataKeys = ['name', 'description', 'type', 'coordinates', 'radius', 'tag', 'group', 'external_id', 'metadata'];
            foreach ($dataKeys as $key) {
                if (isset($args[$key])) {
                    $data[$key] = $args[$key];
                }
            }

            $result = $this->service->createGeofence($data);
            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
