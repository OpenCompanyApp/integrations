<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\Integrations\Nasa\NasaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NasaGetMarsRoverPhotos implements Tool
{
    /**
     * Create a new NasaGetMarsRoverPhotos tool instance.
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
        return 'nasa_get_mars_rover_photos';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Get photos from NASA Mars rovers (Curiosity, Opportunity, Spirit, Perseverance). Query by sol (Martian day) or Earth date, and optionally filter by camera. Returns photo URLs and metadata.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'rover' => ['type' => 'string', 'required' => true, 'description' => 'Rover name: "curiosity", "opportunity", "spirit", or "perseverance".'],
            'sol' => ['type' => 'integer', 'description' => 'The sol (Martian day) number. Use this OR earth_date, not both.'],
            'earth_date' => ['type' => 'string', 'description' => 'Earth date in YYYY-MM-DD format. Use this OR sol, not both.'],
            'camera' => ['type' => 'string', 'description' => 'Camera abbreviation: FHAZ, RHAZ, MAST, CHEMCAM, MAHLI, MARDI, NAVCAM, PANCAM, MINITES, etc.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default 1, 25 photos per page).'],
        ];
    }

    /**
     * Execute the get Mars rover photos tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The Mars rover photos.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('NASA integration is not configured.');
            }

            $rover = $args['rover'];

            $result = $this->service->getMarsRoverPhotos(
                rover: $rover,
                sol: isset($args['sol']) ? (int) $args['sol'] : null,
                earthDate: $args['earth_date'] ?? null,
                camera: $args['camera'] ?? null,
                page: isset($args['page']) ? (int) $args['page'] : null,
            );

            return ToolResult::success($this->formatResponse($result, $rover));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Mars rover photos response into a clean structure.
     *
     * @param  array<string, mixed>  $result  The raw API response.
     * @param  string  $rover  The rover name queried.
     * @return array<string, mixed> The formatted photos data.
     */
    private function formatResponse(array $result, string $rover): array
    {
        $photos = $result['photos'] ?? [];

        $formatted = array_map(function (array $photo): array {
            return [
                'id' => $photo['id'] ?? null,
                'sol' => $photo['sol'] ?? null,
                'earth_date' => $photo['earth_date'] ?? null,
                'camera' => [
                    'name' => $photo['camera']['name'] ?? null,
                    'full_name' => $photo['camera']['full_name'] ?? null,
                ],
                'img_src' => $photo['img_src'] ?? null,
                'rover' => $photo['rover']['name'] ?? null,
            ];
        }, $photos);

        return [
            'rover' => $rover,
            'photos' => $formatted,
            'count' => count($formatted),
        ];
    }
}
