<?php

namespace OpenCompany\Integrations\Celestial\Tools;

use OpenCompany\Integrations\Celestial\CelestialService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CelestialTimeInfo implements Tool
{
    public function __construct(
        private CelestialService $service,
        private string $defaultTimezone = 'UTC',
    ) {}

    public function name(): string
    {
        return 'celestial_time_info';
    }

    public function description(): string
    {
        return 'Get astronomical time data — Julian Day, sidereal time (GMST/GAST), and equation of time.';
    }

    public function parameters(): array
    {
        return [
            'date' => ['type' => 'string', 'description' => "ISO date or datetime (e.g. '2024-06-15'). Defaults to now."],
        ];
    }

    public function execute(array $args): ToolResult
    {
        $date = $args['date'] ?? null;

        try {
            return ToolResult::success($this->service->timeInfo($date));
        } catch (\Throwable $e) {
            return ToolResult::error("Celestial calculation error: {$e->getMessage()}");
        }
    }
}
