<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get Strava athlete stats.
 */
class StravaGetAthleteStats extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_get_athlete_stats';
    }

    public function description(): string
    {
        return 'Get activity totals and recent statistics for a Strava athlete.';
    }

    public function parameters(): array
    {
        return [
            'athlete_id' => ['type' => 'integer', 'required' => true, 'description' => 'Athlete ID.'],
        ];
    }

    /**
     * Get athlete stats.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (!isset($args['athlete_id'])) {
                return ToolResult::error('athlete_id is required.');
            }

            return ToolResult::success($this->service->getAthleteStats((int) $args['athlete_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
