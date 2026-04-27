<?php

namespace OpenCompany\Integrations\GoogleMaps\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\GoogleMaps\GoogleMapsService;

/**
 * Get detailed information for a Google Maps place.
 *
 * Accepts a Place ID and optional field list to keep responses focused.
 */
class GoogleMapsGetPlaceDetails implements Tool
{
    /**
     * @param  GoogleMapsService  $service  The Google Maps API client.
     */
    public function __construct(
        private GoogleMapsService $service,
    ) {}

    public function name(): string
    {
        return 'google_maps_get_place_details';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Google Maps place by Place ID.';
    }

    public function parameters(): array
    {
        return [
            'place_id' => ['type' => 'string', 'required' => true, 'description' => 'Google Place ID.'],
            'fields' => ['type' => 'array', 'description' => 'Optional list of fields to include.', 'items' => ['type' => 'string']],
            'language' => ['type' => 'string', 'description' => 'Optional language code.'],
            'region' => ['type' => 'string', 'description' => 'Optional region code.'],
            'reviews_no_translations' => ['type' => 'string', 'description' => 'Set to "true" to disable review translations.'],
            'reviews_sort' => ['type' => 'string', 'description' => 'Review sort order such as "most_relevant" or "newest".'],
        ];
    }

    /**
     * Get place details.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Maps integration is not configured.');
            }
            if (empty($args['place_id'])) {
                return ToolResult::error('Place ID is required.');
            }

            return ToolResult::success($this->service->getPlaceDetails(
                (string) $args['place_id'],
                is_array($args['fields'] ?? null) ? $args['fields'] : [],
                $args['language'] ?? null,
                $args['region'] ?? null,
                $args['reviews_no_translations'] ?? null,
                $args['reviews_sort'] ?? null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
