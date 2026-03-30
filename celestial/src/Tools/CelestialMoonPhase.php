<?php

namespace OpenCompany\Integrations\Celestial\Tools;

use OpenCompany\Integrations\Celestial\CelestialService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CelestialMoonPhase implements Tool
{
    public function __construct(
        private CelestialService $service,
        private string $defaultTimezone = 'UTC',
    ) {}

    public function name(): string
    {
        return 'celestial_moon_phase';
    }

    public function description(): string
    {
        return 'Get current moon phase, illumination percentage, age, zodiac sign, and dates of next new/full moon.';
    }

    public function parameters(): array
    {
        return [
            'date' => ['type' => 'string', 'description' => "ISO date or datetime (e.g. '2024-06-15' or '2024-06-15 22:00:00'). Defaults to now."],
            'timezone' => ['type' => 'string', 'description' => "Timezone for display (e.g. 'Europe/Amsterdam'). Defaults to org timezone."],
        ];
    }

    public function execute(array $args): ToolResult
    {
        $date = $args['date'] ?? null;
        $timezone = $args['timezone'] ?? $this->defaultTimezone;

        try {
            return ToolResult::success($this->service->moonPhase($date, $timezone));
        } catch (\Throwable $e) {
            return ToolResult::error("Celestial calculation error: {$e->getMessage()}");
        }
    }
}
