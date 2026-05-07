<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get streams for a Strava route.
 */
class StravaGetRouteStreams extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_get_route_streams';
    }

    public function description(): string
    {
        return 'Get route stream coordinates and elevation data for a Strava route.';
    }

    public function parameters(): array
    {
        return [
            'route_id' => ['type' => 'integer', 'required' => true, 'description' => 'Route ID.'],
        ];
    }

    /**
     * Get route streams.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (!isset($args['route_id'])) {
                return ToolResult::error('route_id is required.');
            }

            return ToolResult::success($this->service->getRouteStreams((int) $args['route_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
