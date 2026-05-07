<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get zones for the authenticated Strava athlete.
 */
class StravaGetAthleteZones extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_get_athlete_zones';
    }

    public function description(): string
    {
        return 'Get heart rate and power zones for the authenticated Strava athlete.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get athlete zones.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->getAthleteZones());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
