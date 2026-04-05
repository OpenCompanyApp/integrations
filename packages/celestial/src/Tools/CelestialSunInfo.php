<?php

namespace OpenCompany\Integrations\Celestial\Tools;

use OpenCompany\Integrations\Celestial\CelestialService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CelestialSunInfo implements Tool
{
    public function __construct(
        private CelestialService $service,
        private string $defaultTimezone = 'UTC',
    ) {}

    public function name(): string
    {
        return 'celestial_sun_info';
    }

    public function description(): string
    {
        return 'Get sunrise/sunset times, solar altitude/azimuth, twilight phase, day length, and zodiac position for a location.';
    }

    public function parameters(): array
    {
        return [
            'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Observer latitude (-90 to 90).'],
            'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Observer longitude (-180 to 180).'],
            'date' => ['type' => 'string', 'description' => "ISO date or datetime (e.g. '2024-06-15'). Defaults to now."],
            'timezone' => ['type' => 'string', 'description' => "Timezone for display (e.g. 'Europe/Amsterdam'). Defaults to org timezone."],
        ];
    }

    public function execute(array $args): ToolResult
    {
        $date = $args['date'] ?? null;
        $lat = isset($args['latitude']) ? (float) $args['latitude'] : 0;
        $lon = isset($args['longitude']) ? (float) $args['longitude'] : 0;
        $timezone = $args['timezone'] ?? $this->defaultTimezone;

        try {
            return ToolResult::success($this->service->sunInfo($date, $lat, $lon, $timezone));
        } catch (\Throwable $e) {
            return ToolResult::error("Celestial calculation error: {$e->getMessage()}");
        }
    }
}
