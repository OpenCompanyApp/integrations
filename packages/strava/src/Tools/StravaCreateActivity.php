<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\Integrations\Strava\StravaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a manual Strava activity.
 */
class StravaCreateActivity implements Tool
{
    /**
     * @param  StravaService  $service  The Strava service instance.
     */
    public function __construct(
        private StravaService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'strava_create_activity';
    }

    /**
     * A description of what this tool does, shown to AI agents.
     */
    public function description(): string
    {
        return 'Create a manual activity on Strava. Requires a name, activity type, start date, and elapsed time in seconds.';
    }

    /**
     * Parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the activity (e.g., "Morning Run").'],
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Activity type: Run, Ride, Swim, Hike, Walk, Workout, WeightTraining, Yoga, etc.'],
            'start_date_local' => ['type' => 'string', 'required' => true, 'description' => 'ISO 8601 local start date and time (e.g., "2025-01-15T09:30:00").'],
            'elapsed_time' => ['type' => 'integer', 'required' => true, 'description' => 'Elapsed time in seconds.'],
            'description' => ['type' => 'string', 'description' => 'Description of the activity.'],
            'distance' => ['type' => 'number', 'description' => 'Distance in meters.'],
            'trainer' => ['type' => 'integer', 'description' => 'Set to 1 if this is a trainer/trainer ride activity.'],
            'commute' => ['type' => 'integer', 'description' => 'Set to 1 if this is a commute activity.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Strava integration is not configured.');
            }

            $required = ['name', 'type', 'start_date_local', 'elapsed_time'];
            foreach ($required as $field) {
                if (empty($args[$field])) {
                    return ToolResult::error("{$field} is required.");
                }
            }

            $extra = [];
            $optionalFields = ['description', 'distance', 'trainer', 'commute'];
            foreach ($optionalFields as $field) {
                if (isset($args[$field])) {
                    $extra[$field] = $args[$field];
                }
            }

            $result = $this->service->createActivity(
                name: $args['name'],
                type: $args['type'],
                startDateLocal: $args['start_date_local'],
                elapsedTime: (int) $args['elapsed_time'],
                extra: $extra,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
