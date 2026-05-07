<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Export a Strava route.
 */
class StravaExportRoute extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_export_route';
    }

    public function description(): string
    {
        return 'Export a Strava route as GPX or TCX.';
    }

    public function parameters(): array
    {
        return [
            'route_id' => ['type' => 'integer', 'required' => true, 'description' => 'Route ID.'],
            'format' => ['type' => 'string', 'required' => true, 'enum' => ['gpx', 'tcx'], 'description' => 'Export format.'],
        ];
    }

    /**
     * Export a route.
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
            if (empty($args['format'])) {
                return ToolResult::error('format is required.');
            }

            return ToolResult::success($this->service->exportRoute((int) $args['route_id'], (string) $args['format']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
