<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get streams for a Strava segment.
 */
class StravaGetSegmentStreams extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_get_segment_streams';
    }

    public function description(): string
    {
        return 'Get stream data for a Strava segment.';
    }

    public function parameters(): array
    {
        return [
            'segment_id' => ['type' => 'integer', 'required' => true, 'description' => 'Segment ID.'],
            'keys' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'string'], 'description' => 'Stream keys to request.'],
            'resolution' => ['type' => 'string', 'enum' => ['low', 'medium', 'high'], 'description' => 'Optional stream resolution.'],
            'series_type' => ['type' => 'string', 'enum' => ['time', 'distance'], 'description' => 'Optional series type.'],
        ];
    }

    /**
     * Get segment streams.
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
            if (!is_array($args['keys'] ?? null) || $args['keys'] === []) {
                return ToolResult::error('keys is required.');
            }

            return ToolResult::success($this->service->getSegmentStreams(
                (int) $args['segment_id'],
                array_map('strval', $args['keys']),
                isset($args['resolution']) && is_scalar($args['resolution']) ? (string) $args['resolution'] : null,
                isset($args['series_type']) && is_scalar($args['series_type']) ? (string) $args['series_type'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
