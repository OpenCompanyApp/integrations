<?php

namespace OpenCompany\Integrations\GoogleMaps\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\GoogleMaps\GoogleMapsService;

/**
 * Calculate travel distances and durations for origin-destination pairs.
 *
 * Uses the Google Maps Distance Matrix API with optional routing preferences.
 */
class GoogleMapsGetDistanceMatrix implements Tool
{
    /**
     * @param  GoogleMapsService  $service  The Google Maps API client.
     */
    public function __construct(
        private GoogleMapsService $service,
    ) {}

    public function name(): string
    {
        return 'google_maps_get_distance_matrix';
    }

    public function description(): string
    {
        return 'Calculate travel distances and durations between multiple origins and destinations.';
    }

    public function parameters(): array
    {
        return [
            'origins' => ['type' => 'array', 'required' => true, 'description' => 'Origin addresses or "lat,lng" strings.', 'items' => ['type' => 'string']],
            'destinations' => ['type' => 'array', 'required' => true, 'description' => 'Destination addresses or "lat,lng" strings.', 'items' => ['type' => 'string']],
            'mode' => ['type' => 'string', 'description' => 'Travel mode: driving, walking, bicycling, or transit.'],
            'language' => ['type' => 'string', 'description' => 'Optional language code.'],
            'units' => ['type' => 'string', 'description' => 'Unit system: metric or imperial.'],
            'departure_time' => ['type' => 'string', 'description' => 'Departure time as "now" or Unix timestamp.'],
            'arrival_time' => ['type' => 'string', 'description' => 'Arrival time as Unix timestamp for transit.'],
            'avoid' => ['type' => 'array', 'description' => 'Avoid options such as tolls, highways, ferries.', 'items' => ['type' => 'string']],
            'transit_mode' => ['type' => 'string', 'description' => 'Transit modes as a pipe-separated string.'],
            'transit_routing_preference' => ['type' => 'string', 'description' => 'Transit preference: less_walking or fewer_transfers.'],
        ];
    }

    /**
     * Get a distance matrix.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Maps integration is not configured.');
            }
            if (empty($args['origins']) || empty($args['destinations']) || !is_array($args['origins']) || !is_array($args['destinations'])) {
                return ToolResult::error('Origins and destinations arrays are required.');
            }

            return ToolResult::success($this->service->getDistanceMatrix(
                $args['origins'],
                $args['destinations'],
                $args['mode'] ?? null,
                $args['language'] ?? null,
                $args['units'] ?? null,
                $args['departure_time'] ?? null,
                $args['arrival_time'] ?? null,
                is_array($args['avoid'] ?? null) ? $args['avoid'] : [],
                $args['transit_mode'] ?? null,
                $args['transit_routing_preference'] ?? null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
