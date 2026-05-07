<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Star or unstar a Strava segment.
 */
class StravaStarSegment extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_star_segment';
    }

    public function description(): string
    {
        return 'Star or unstar a Strava segment for the authenticated athlete.';
    }

    public function parameters(): array
    {
        return [
            'segment_id' => ['type' => 'integer', 'required' => true, 'description' => 'Segment ID.'],
            'starred' => ['type' => 'boolean', 'required' => true, 'description' => 'Whether the segment should be starred.'],
        ];
    }

    /**
     * Star or unstar a segment.
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
            if (!array_key_exists('starred', $args)) {
                return ToolResult::error('starred is required.');
            }

            return ToolResult::success($this->service->starSegment((int) $args['segment_id'], (bool) $args['starred']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
