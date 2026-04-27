<?php

namespace OpenCompany\Integrations\GoogleMaps\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\GoogleMaps\GoogleMapsService;

/**
 * Search for places using Google Maps text search.
 *
 * Supports optional location bias, radius, type, price, language, and open-now
 * filters.
 */
class GoogleMapsSearchPlaces implements Tool
{
    /**
     * @param  GoogleMapsService  $service  The Google Maps API client.
     */
    public function __construct(
        private GoogleMapsService $service,
    ) {}

    public function name(): string
    {
        return 'google_maps_search_places';
    }

    public function description(): string
    {
        return 'Search for places with a text query using Google Maps Places search.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Text search query such as "restaurants in Sydney".'],
            'location' => ['type' => 'string', 'description' => 'Optional location bias as "lat,lng".'],
            'radius' => ['type' => 'number', 'description' => 'Optional radius in meters.'],
            'language' => ['type' => 'string', 'description' => 'Optional language code.'],
            'type' => ['type' => 'string', 'description' => 'Optional place type such as "restaurant".'],
            'open_now' => ['type' => 'boolean', 'description' => 'Whether to return only places open now.'],
            'min_price' => ['type' => 'integer', 'description' => 'Optional minimum price level from 0 to 4.'],
            'max_price' => ['type' => 'integer', 'description' => 'Optional maximum price level from 0 to 4.'],
        ];
    }

    /**
     * Search places.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Maps integration is not configured.');
            }
            if (empty($args['query'])) {
                return ToolResult::error('Query is required.');
            }

            return ToolResult::success($this->service->searchPlaces(
                (string) $args['query'],
                $args['location'] ?? null,
                isset($args['radius']) ? (float) $args['radius'] : null,
                $args['language'] ?? null,
                $args['type'] ?? null,
                (bool) ($args['open_now'] ?? false),
                isset($args['min_price']) ? (int) $args['min_price'] : null,
                isset($args['max_price']) ? (int) $args['max_price'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
