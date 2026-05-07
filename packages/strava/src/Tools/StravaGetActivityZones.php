<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get zones for a Strava activity.
 */
class StravaGetActivityZones extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_get_activity_zones';
    }

    public function description(): string
    {
        return 'Get heart rate and power zone distribution for a Strava activity when available.';
    }

    public function parameters(): array
    {
        return [
            'activity_id' => ['type' => 'integer', 'required' => true, 'description' => 'Activity ID.'],
        ];
    }

    /**
     * Get activity zones.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (!isset($args['activity_id'])) {
                return ToolResult::error('activity_id is required.');
            }

            return ToolResult::success($this->service->getActivityZones((int) $args['activity_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
