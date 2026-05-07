<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Nasa\NasaService;

/**
 * Retrieve NASA Earth imagery for a coordinate.
 */
class NasaGetEarthImagery implements Tool
{
    /**
     * @param  NasaService  $service  The NASA API client.
     */
    public function __construct(private NasaService $service) {}

    public function name(): string
    {
        return 'nasa_get_earth_imagery';
    }

    public function description(): string
    {
        return 'Get Landsat Earth imagery for a longitude, latitude, date, and optional image dimension.';
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
     * Fetch Earth imagery.
     *
     * @param  array<string, mixed>  $args  Tool arguments (lon, lat, date, dim).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('NASA integration is not configured.');
            }

            return ToolResult::success($this->service->getEarthImagery(array_filter([
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
