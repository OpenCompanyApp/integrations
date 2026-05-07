<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Strava segment effort.
 */
class StravaGetSegmentEffort extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_get_segment_effort';
    }

    public function description(): string
    {
        return 'Get a Strava segment effort by ID.';
    }

    public function parameters(): array
    {
        return [
            'effort_id' => ['type' => 'integer', 'required' => true, 'description' => 'Segment effort ID.'],
        ];
    }

    /**
     * Get a segment effort.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (!isset($args['effort_id'])) {
                return ToolResult::error('effort_id is required.');
            }

            return ToolResult::success($this->service->getSegmentEffort((int) $args['effort_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
