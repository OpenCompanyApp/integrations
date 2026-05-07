<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Nasa\NasaService;

/**
 * Retrieve available NASA Earth asset dates for a coordinate.
 */
class NasaGetEarthAssets implements Tool
{
    /**
     * @param  NasaService  $service  The NASA API client.
     */
    public function __construct(private NasaService $service) {}

    public function name(): string
    {
        return 'nasa_get_earth_assets';
    }

    public function description(): string
    {
        return 'Get available Landsat Earth asset dates for a longitude, latitude, optional date, and optional dimension.';
    }

    public function parameters(): array
    {
        return [
            'lon' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
            'lat' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
            'date' => ['type' => 'string', 'description' => 'Optional date in YYYY-MM-DD format.'],
            'dim' => ['type' => 'number', 'description' => 'Optional image width and height in degrees.'],
        ];
    }

    /**
     * Fetch Earth asset dates.
     *
     * @param  array<string, mixed>  $args  Tool arguments (lon, lat, date, dim).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('NASA integration is not configured.');
            }

            return ToolResult::success($this->service->getEarthAssets(array_filter([
                'lon' => $args['lon'],
                'lat' => $args['lat'],
                'date' => $args['date'] ?? null,
                'dim' => $args['dim'] ?? null,
            ], static fn (mixed $value): bool => $value !== null && $value !== '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
