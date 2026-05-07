<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Explore Strava segments in a bounding box.
 */
class StravaExploreSegments extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_explore_segments';
    }

    public function description(): string
    {
        return 'Explore top Strava segments in a bounding box.';
    }

    public function parameters(): array
    {
        return [
            'bounds' => ['type' => 'array', 'required' => true, 'description' => 'Bounding box as southwest lat/lng and northeast lat/lng: [sw_lat, sw_lng, ne_lat, ne_lng].'],
            'activity_type' => ['type' => 'string', 'enum' => ['ride', 'running'], 'description' => 'Segment activity type.'],
            'min_cat' => ['type' => 'integer', 'description' => 'Minimum climb category.'],
            'max_cat' => ['type' => 'integer', 'description' => 'Maximum climb category.'],
        ];
    }

    /**
     * Explore segments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (!is_array($args['bounds'] ?? null) || count($args['bounds']) !== 4) {
                return ToolResult::error('bounds must contain four coordinates.');
            }

            return ToolResult::success($this->service->exploreSegments(
                $args['bounds'],
                isset($args['activity_type']) && is_scalar($args['activity_type']) ? (string) $args['activity_type'] : null,
                isset($args['min_cat']) ? (int) $args['min_cat'] : null,
                isset($args['max_cat']) ? (int) $args['max_cat'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
