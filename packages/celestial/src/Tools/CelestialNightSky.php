<?php

namespace OpenCompany\Integrations\Celestial\Tools;

use OpenCompany\Integrations\Celestial\CelestialService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CelestialNightSky implements Tool
{
    public function __construct(
        private CelestialService $service,
        private string $defaultTimezone = 'UTC',
    ) {}

    public function name(): string
    {
        return 'celestial_night_sky';
    }

    public function description(): string
    {
        return 'Get what\'s visible in the night sky right now: sun/moon/planet positions, darkness level, and stargazing quality for a location.';
    }

    public function parameters(): array
    {
        return [
            'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Observer latitude (-90 to 90).'],
            'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Observer longitude (-180 to 180).'],
            'timezone' => ['type' => 'string', 'description' => "Timezone for display (e.g. 'Europe/Amsterdam'). Defaults to org timezone."],
        ];
    }

    public function execute(array $args): ToolResult
    {
        $lat = isset($args['latitude']) ? (float) $args['latitude'] : 0;
        $lon = isset($args['longitude']) ? (float) $args['longitude'] : 0;
        $timezone = $args['timezone'] ?? $this->defaultTimezone;

        try {
            return ToolResult::success($this->service->nightSky($lat, $lon, $timezone));
        } catch (\Throwable $e) {
            return ToolResult::error("Celestial calculation error: {$e->getMessage()}");
        }
    }
}
