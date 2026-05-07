<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get streams for a Strava activity.
 */
class StravaGetActivityStreams extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_get_activity_streams';
    }

    public function description(): string
    {
        return 'Get activity stream data such as time, distance, latlng, altitude, velocity_smooth, heartrate, cadence, watts, temp, moving, or grade_smooth.';
    }

    public function parameters(): array
    {
        return [
            'activity_id' => ['type' => 'integer', 'required' => true, 'description' => 'Activity ID.'],
            'keys' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'string'], 'description' => 'Stream keys to request.'],
            'resolution' => ['type' => 'string', 'enum' => ['low', 'medium', 'high'], 'description' => 'Optional stream resolution.'],
            'series_type' => ['type' => 'string', 'enum' => ['time', 'distance'], 'description' => 'Optional series type.'],
        ];
    }

    /**
     * Fetch activity streams.
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
            if (!is_array($args['keys'] ?? null) || $args['keys'] === []) {
                return ToolResult::error('keys is required.');
            }

            return ToolResult::success($this->service->getActivityStreams(
                (int) $args['activity_id'],
                array_map('strval', $args['keys']),
                isset($args['resolution']) && is_scalar($args['resolution']) ? (string) $args['resolution'] : null,
                isset($args['series_type']) && is_scalar($args['series_type']) ? (string) $args['series_type'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
