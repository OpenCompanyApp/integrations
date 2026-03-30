<?php

namespace OpenCompany\Integrations\Celestial\Tools;

use OpenCompany\Integrations\Celestial\CelestialService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CelestialLunarEclipse implements Tool
{
    public function __construct(
        private CelestialService $service,
        private string $defaultTimezone = 'UTC',
    ) {}

    public function name(): string
    {
        return 'celestial_lunar_eclipse';
    }

    public function description(): string
    {
        return 'Get lunar eclipse data for a specific date — eclipse type, magnitude, gamma, contact times (P1-P4, U1-U4), and semi-durations.';
    }

    public function parameters(): array
    {
        return [
            'date' => ['type' => 'string', 'required' => true, 'description' => "ISO date (e.g. '2024-09-18'). Defaults to today."],
        ];
    }

    public function execute(array $args): ToolResult
    {
        $date = $args['date'] ?? date('Y-m-d');

        try {
            return ToolResult::success($this->service->lunarEclipse($date));
        } catch (\Throwable $e) {
            return ToolResult::error("Celestial calculation error: {$e->getMessage()}");
        }
    }
}
