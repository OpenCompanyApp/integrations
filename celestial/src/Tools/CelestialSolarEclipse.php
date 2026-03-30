<?php

namespace OpenCompany\Integrations\Celestial\Tools;

use OpenCompany\Integrations\Celestial\CelestialService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CelestialSolarEclipse implements Tool
{
    public function __construct(
        private CelestialService $service,
        private string $defaultTimezone = 'UTC',
    ) {}

    public function name(): string
    {
        return 'celestial_solar_eclipse';
    }

    public function description(): string
    {
        return 'Get solar eclipse data for a specific date and location — eclipse type, obscuration, contacts, and magnitude.';
    }

    public function parameters(): array
    {
        return [
            'date' => ['type' => 'string', 'required' => true, 'description' => "ISO date (e.g. '2024-04-08'). Defaults to today."],
            'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Observer latitude (-90 to 90).'],
            'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Observer longitude (-180 to 180).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        $date = $args['date'] ?? date('Y-m-d');
        $lat = isset($args['latitude']) ? (float) $args['latitude'] : 0;
        $lon = isset($args['longitude']) ? (float) $args['longitude'] : 0;

        try {
            return ToolResult::success($this->service->solarEclipse($date, $lat, $lon));
        } catch (\Throwable $e) {
            return ToolResult::error("Celestial calculation error: {$e->getMessage()}");
        }
    }
}
