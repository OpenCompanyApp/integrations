<?php

namespace OpenCompany\Integrations\Radar\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolResult;
use OpenCompany\Integrations\Radar\RadarService;

class RadarGetGeofence implements Tool
{
    public function __construct(private RadarService $service) {}

    public function name(): string
    {
        return 'radar_get_geofence';
    }

    public function description(): string
    {
        return 'Retrieve detailed information about a specific geofence by its ID.';
    }

    public function parameters(): array
    {
        return [
            'geofence_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the geofence to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Radar integration is not configured.');
            }

            $result = $this->service->getGeofence($args['geofence_id']);
            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
