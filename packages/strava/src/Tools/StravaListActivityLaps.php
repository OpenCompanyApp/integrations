<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List laps for a Strava activity.
 */
class StravaListActivityLaps extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_list_activity_laps';
    }

    public function description(): string
    {
        return 'List laps for a Strava activity.';
    }

    public function parameters(): array
    {
        return [
            'activity_id' => ['type' => 'integer', 'required' => true, 'description' => 'Activity ID.'],
        ];
    }

    /**
     * List activity laps.
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

            return ToolResult::success($this->service->listActivityLaps((int) $args['activity_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
