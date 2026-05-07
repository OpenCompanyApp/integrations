<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Strava segment.
 */
class StravaGetSegment extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_get_segment';
    }

    public function description(): string
    {
        return 'Get details for a Strava segment by ID.';
    }

    public function parameters(): array
    {
        return [
            'segment_id' => ['type' => 'integer', 'required' => true, 'description' => 'Segment ID.'],
        ];
    }

    /**
     * Get a segment.
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

            return ToolResult::success($this->service->getSegment((int) $args['segment_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
