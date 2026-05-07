<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List efforts for a Strava segment.
 */
class StravaListSegmentEfforts extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_list_segment_efforts';
    }

    public function description(): string
    {
        return 'List efforts for the authenticated athlete on a Strava segment.';
    }

    public function parameters(): array
    {
        return [
            'segment_id' => ['type' => 'integer', 'required' => true, 'description' => 'Segment ID.'],
            'start_date_local' => ['type' => 'string', 'description' => 'Start date filter.'],
            'end_date_local' => ['type' => 'string', 'description' => 'End date filter.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Items per page.'],
        ];
    }

    /**
     * List segment efforts.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (!isset($args['segment_id'])) {
                return ToolResult::error('segment_id is required.');
            }

            return ToolResult::success($this->service->listSegmentEfforts((int) $args['segment_id'], $this->only($args, [
                'start_date_local',
                'end_date_local',
                'page',
                'per_page',
            ])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
