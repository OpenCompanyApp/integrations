<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Strava activity.
 */
class StravaUpdateActivity extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_update_activity';
    }

    public function description(): string
    {
        return 'Update editable fields on a Strava activity, such as name, type, sport_type, description, commute, trainer, or privacy.';
    }

    public function parameters(): array
    {
        return [
            'activity_id' => ['type' => 'integer', 'required' => true, 'description' => 'Activity ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Official activity update payload.'],
        ];
    }

    /**
     * Update an activity.
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
            if (!is_array($args['payload'] ?? null) || $args['payload'] === []) {
                return ToolResult::error('payload is required.');
            }

            return ToolResult::success($this->service->updateActivity((int) $args['activity_id'], $args['payload']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
