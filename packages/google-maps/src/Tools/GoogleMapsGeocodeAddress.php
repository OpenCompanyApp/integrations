<?php

namespace OpenCompany\Integrations\GoogleMaps\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\GoogleMaps\GoogleMapsService;

/**
 * Convert a street address into geographic coordinates.
 *
 * Uses the Google Maps Geocoding API and supports optional component,
 * region, and language filters.
 */
class GoogleMapsGeocodeAddress implements Tool
{
    /**
     * @param  GoogleMapsService  $service  The Google Maps API client.
     */
    public function __construct(
        private GoogleMapsService $service,
    ) {}

    public function name(): string
    {
        return 'google_maps_geocode_address';
    }

    public function description(): string
    {
        return 'Convert a street address into geographic coordinates and place details using Google Maps geocoding.';
    }

    public function parameters(): array
    {
        return [
            'address' => ['type' => 'string', 'required' => true, 'description' => 'Street address to geocode.'],
            'components' => ['type' => 'object', 'description' => 'Optional component filters such as {"country": "US"}.'],
            'region' => ['type' => 'string', 'description' => 'Optional region bias such as "us".'],
            'language' => ['type' => 'string', 'description' => 'Optional language code such as "en".'],
        ];
    }

    /**
     * Geocode an address.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Maps integration is not configured.');
            }
            if (empty($args['address'])) {
                return ToolResult::error('Address is required.');
            }

            return ToolResult::success($this->service->geocodeAddress(
                (string) $args['address'],
                is_array($args['components'] ?? null) ? $args['components'] : [],
                $args['region'] ?? null,
                $args['language'] ?? null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
