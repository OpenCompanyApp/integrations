<?php

namespace OpenCompany\Integrations\GoogleMaps\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\GoogleMaps\GoogleMapsService;

/**
 * Get directions between an origin and destination.
 *
 * Supports Google Maps travel modes, waypoints, alternatives, avoidance,
 * transit preferences, units, and language.
 */
class GoogleMapsGetDirections implements Tool
{
    /**
     * @param  GoogleMapsService  $service  The Google Maps API client.
     */
    public function __construct(
        private GoogleMapsService $service,
    ) {}

    public function name(): string
    {
        return 'google_maps_get_directions';
    }

    public function description(): string
    {
        return 'Get directions between an origin and destination using Google Maps Directions API.';
    }

    public function parameters(): array
    {
        return [
            'origin' => ['type' => 'string', 'required' => true, 'description' => 'Starting point as address, Place ID, or "lat,lng".'],
            'destination' => ['type' => 'string', 'required' => true, 'description' => 'Destination as address, Place ID, or "lat,lng".'],
            'mode' => ['type' => 'string', 'description' => 'Travel mode: driving, walking, bicycling, or transit.'],
            'waypoints' => ['type' => 'string', 'description' => 'Optional pipe-separated waypoints.'],
            'alternatives' => ['type' => 'boolean', 'description' => 'Whether to return alternative routes.'],
            'avoid' => ['type' => 'array', 'description' => 'Avoid options such as tolls, highways, ferries.', 'items' => ['type' => 'string']],
            'language' => ['type' => 'string', 'description' => 'Optional language code.'],
            'units' => ['type' => 'string', 'description' => 'Unit system: metric or imperial.'],
            'departure_time' => ['type' => 'string', 'description' => 'Departure time as "now" or Unix timestamp.'],
            'arrival_time' => ['type' => 'string', 'description' => 'Arrival time as Unix timestamp for transit.'],
            'transit_mode' => ['type' => 'string', 'description' => 'Transit modes such as bus, subway, train, tram, or rail.'],
            'transit_routing_preference' => ['type' => 'string', 'description' => 'Transit preference: less_walking or fewer_transfers.'],
        ];
    }

    /**
     * Get directions.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Maps integration is not configured.');
            }
            if (empty($args['origin']) || empty($args['destination'])) {
                return ToolResult::error('Origin and destination are required.');
            }

            return ToolResult::success($this->service->getDirections(
                (string) $args['origin'],
                (string) $args['destination'],
                $args['mode'] ?? null,
                $args['waypoints'] ?? null,
                (bool) ($args['alternatives'] ?? false),
                is_array($args['avoid'] ?? null) ? $args['avoid'] : [],
                $args['language'] ?? null,
                $args['units'] ?? null,
                $args['departure_time'] ?? null,
                $args['arrival_time'] ?? null,
                $args['transit_mode'] ?? null,
                $args['transit_routing_preference'] ?? null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
