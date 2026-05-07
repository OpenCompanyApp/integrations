<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\Integrations\Nasa\NasaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve one NASA Near Earth Object by ID.
 */
class NasaGetAsteroid implements Tool
{
    /**
     * Create a new NasaGetAsteroid tool instance.
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
        return 'nasa_get_asteroid';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific Near Earth Object (asteroid) by its NASA ID. Returns orbital data, estimated diameter, close approach history, and hazard assessment.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The asteroid\'s unique NASA ID (e.g., "2534304"). You can find IDs using the nasa_get_asteroids tool.'],
        ];
    }

    /**
     * Execute the get asteroid tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The asteroid details.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('NASA integration is not configured.');
            }

            $result = $this->service->getAsteroid($args['id']);

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the asteroid detail response into a clean structure.
     *
     * @param  array<string, mixed>  $result  The raw API response.
     * @return array<string, mixed> The formatted asteroid details.
     */
    private function formatResponse(array $result): array
    {
        $estimatedDiameter = $result['estimated_diameter']['kilometers'] ?? [];
        $closeApproaches = $result['close_approach_data'] ?? [];

        $formattedApproaches = array_map(function (array $approach): array {
            return [
                'date' => $approach['close_approach_date'] ?? null,
                'velocity_km_s' => $approach['relative_velocity']['kilometers_per_second'] ?? null,
                'miss_distance_km' => $approach['miss_distance']['kilometers'] ?? null,
                'orbiting_body' => $approach['orbiting_body'] ?? null,
            ];
        }, $closeApproaches);

        return [
            'id' => $result['id'] ?? null,
            'neo_reference_id' => $result['neo_reference_id'] ?? null,
            'name' => $result['name'] ?? null,
            'nasa_jpl_url' => $result['nasa_jpl_url'] ?? null,
            'absolute_magnitude_h' => $result['absolute_magnitude_h'] ?? null,
            'estimated_diameter_km' => [
                'min' => $estimatedDiameter['estimated_diameter_min'] ?? null,
                'max' => $estimatedDiameter['estimated_diameter_max'] ?? null,
            ],
            'is_potentially_hazardous' => $result['is_potentially_hazardous_asteroid'] ?? false,
            'close_approaches' => $formattedApproaches,
            'orbital_data' => isset($result['orbital_data']) ? [
                'orbit_id' => $result['orbital_data']['orbit_id'] ?? null,
                'orbit_determination_date' => $result['orbital_data']['orbit_determination_date'] ?? null,
                'first_observation_date' => $result['orbital_data']['first_observation_date'] ?? null,
                'last_observation_date' => $result['orbital_data']['last_observation_date'] ?? null,
                'orbital_period' => $result['orbital_data']['orbital_period'] ?? null,
            ] : null,
            'is_sentry_object' => $result['is_sentry_object'] ?? false,
        ];
    }
}
