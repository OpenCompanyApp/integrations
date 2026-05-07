<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get one Strava route.
 */
class StravaGetRoute extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_get_route';
    }

    public function description(): string
    {
        return 'Get details for a Strava route by ID.';
    }

    public function parameters(): array
    {
        return [
            'route_id' => ['type' => 'integer', 'required' => true, 'description' => 'Route ID.'],
        ];
    }

    /**
     * Get a route.
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

            return ToolResult::success($this->service->getRoute((int) $args['route_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
