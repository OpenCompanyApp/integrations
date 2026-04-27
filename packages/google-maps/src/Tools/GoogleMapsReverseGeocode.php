<?php

namespace OpenCompany\Integrations\GoogleMaps\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\GoogleMaps\GoogleMapsService;

/**
 * Convert coordinates into human-readable addresses.
 *
 * Uses the Google Maps reverse geocoding endpoint with optional result and
 * location type filters.
 */
class GoogleMapsReverseGeocode implements Tool
{
    /**
     * @param  GoogleMapsService  $service  The Google Maps API client.
     */
    public function __construct(
        private GoogleMapsService $service,
    ) {}

    public function name(): string
    {
        return 'google_maps_reverse_geocode';
    }

    public function description(): string
    {
        return 'Convert latitude and longitude coordinates into street addresses using Google Maps reverse geocoding.';
    }

    public function parameters(): array
    {
        return [
            'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Latitude coordinate.'],
            'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Longitude coordinate.'],
            'components' => ['type' => 'object', 'description' => 'Optional component filters.'],
            'language' => ['type' => 'string', 'description' => 'Optional language code.'],
            'result_type' => ['type' => 'string', 'description' => 'Optional result type filter such as "street_address".'],
            'location_type' => ['type' => 'string', 'description' => 'Optional location type filter such as "ROOFTOP".'],
        ];
    }

    /**
     * Reverse geocode coordinates.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Maps integration is not configured.');
            }
            if (!isset($args['latitude'], $args['longitude'])) {
                return ToolResult::error('Latitude and longitude are required.');
            }

            return ToolResult::success($this->service->reverseGeocode(
                (float) $args['latitude'],
                (float) $args['longitude'],
                is_array($args['components'] ?? null) ? $args['components'] : [],
                $args['language'] ?? null,
                $args['result_type'] ?? null,
                $args['location_type'] ?? null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
