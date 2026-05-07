<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\Integrations\Nasa\NasaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch NASA Near Earth Object feed results for a date range.
 */
class NasaGetAsteroids implements Tool
{
    /**
     * Create a new NasaGetAsteroids tool instance.
     *
     * @param  NasaService  $service  The NASA service for making API calls.
     */
    public function __construct(
        private NasaService $service,
    ) {}

    /**
     * Get the tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'nasa_get_asteroids';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Get Near Earth Objects (asteroids) for a date range from NASA. Returns a list of asteroids with their estimated diameter, velocity, distance from Earth, and whether they are potentially hazardous.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'start_date' => ['type' => 'string', 'description' => 'Start date in YYYY-MM-DD format (defaults to today).'],
            'end_date' => ['type' => 'string', 'description' => 'End date in YYYY-MM-DD format (max 7 days after start_date).'],
        ];
    }

    /**
     * Execute the get asteroids tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The asteroid feed data.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('NASA integration is not configured.');
            }

            $result = $this->service->getAsteroids(
                startDate: $args['start_date'] ?? null,
                endDate: $args['end_date'] ?? null,
            );

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the asteroids feed response into a clean structure.
     *
     * @param  array<string, mixed>  $result  The raw API response.
     * @return array<string, mixed> The formatted asteroid data.
     */
    private function formatResponse(array $result): array
    {
        $nearEarthObjects = $result['near_earth_objects'] ?? [];

        $days = [];
        $totalCount = 0;

        foreach ($nearEarthObjects as $date => $asteroids) {
            $formatted = array_map(function (array $asteroid): array {
                $estimatedDiameter = $asteroid['estimated_diameter']['kilometers'] ?? [];

                $closeApproach = $asteroid['close_approach_data'][0] ?? [];

                return [
                    'id' => $asteroid['id'] ?? null,
                    'neo_reference_id' => $asteroid['neo_reference_id'] ?? null,
                    'name' => $asteroid['name'] ?? null,
                    'nasa_jpl_url' => $asteroid['nasa_jpl_url'] ?? null,
                    'absolute_magnitude_h' => $asteroid['absolute_magnitude_h'] ?? null,
                    'estimated_diameter_km' => [
                        'min' => $estimatedDiameter['estimated_diameter_min'] ?? null,
                        'max' => $estimatedDiameter['estimated_diameter_max'] ?? null,
                    ],
                    'is_potentially_hazardous' => $asteroid['is_potentially_hazardous_asteroid'] ?? false,
                    'close_approach' => !empty($closeApproach) ? [
                        'date' => $closeApproach['close_approach_date'] ?? null,
                        'velocity_km_s' => $closeApproach['relative_velocity']['kilometers_per_second'] ?? null,
                        'miss_distance_km' => $closeApproach['miss_distance']['kilometers'] ?? null,
                        'orbiting_body' => $closeApproach['orbiting_body'] ?? null,
                    ] : null,
                ];
            }, $asteroids);

            $days[$date] = $formatted;
            $totalCount += count($formatted);
        }

        return [
            'element_count' => $result['element_count'] ?? $totalCount,
            'near_earth_objects' => $days,
            'total_asteroids' => $totalCount,
        ];
    }
}
