<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\Integrations\Strava\StravaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StravaCreateActivity implements Tool
{
    public function __construct(
        private StravaService $service,
    ) {}

    public function name(): string
    {
        return 'strava_create_activity';
    }

    public function description(): string
    {
        return 'Create a manual activity on Strava. Provide a name, sport type, start date/time, and duration in seconds.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the activity.'],
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Activity type (e.g., "Run", "Ride", "Swim", "Hike", "Walk", "WeightTraining").'],
            'start_date_local' => ['type' => 'string', 'required' => true, 'description' => 'Local start date and time in ISO 8601 format (e.g., "2026-04-05T10:00:00").'],
            'elapsed_time' => ['type' => 'integer', 'required' => true, 'description' => 'Total elapsed time in seconds.'],
            'description' => ['type' => 'string', 'description' => 'Description of the activity.'],
            'distance' => ['type' => 'number', 'description' => 'Distance in meters.'],
            'trainer' => ['type' => 'integer', 'description' => 'Set to 1 if this is a trainer activity.'],
            'commute' => ['type' => 'integer', 'description' => 'Set to 1 if this is a commute.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Strava integration is not configured.');
            }

            $required = ['name', 'type', 'start_date_local', 'elapsed_time'];
            foreach ($required as $field) {
                if (!isset($args[$field]) || $args[$field] === '') {
                    return ToolResult::error("The field '{$field}' is required.");
                }
            }

            $extra = [];
            foreach (['description', 'distance', 'trainer', 'commute'] as $optional) {
                if (isset($args[$optional])) {
                    $extra[$optional] = $args[$optional];
                }
            }

            $result = $this->service->createActivity(
                $args['name'],
                $args['type'],
                $args['start_date_local'],
                (int) $args['elapsed_time'],
                $extra,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
