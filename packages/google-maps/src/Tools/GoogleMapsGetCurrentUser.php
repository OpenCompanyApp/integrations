<?php

namespace OpenCompany\Integrations\GoogleMaps\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\GoogleMaps\GoogleMapsService;

/**
 * Get geolocation data for the current requester.
 *
 * Uses the Google Maps Geolocation API to verify credentials and estimate the
 * caller location from network data.
 */
class GoogleMapsGetCurrentUser implements Tool
{
    /**
     * @param  GoogleMapsService  $service  The Google Maps API client.
     */
    public function __construct(
        private GoogleMapsService $service,
    ) {}

    public function name(): string
    {
        return 'google_maps_get_current_user';
    }

    public function description(): string
    {
        return 'Get geolocation data for the current requester and verify Google Maps API credentials.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get current requester geolocation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Maps integration is not configured.');
            }

            return ToolResult::success($this->service->getCurrentUser());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
