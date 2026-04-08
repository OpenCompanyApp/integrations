<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\Integrations\Strava\StravaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StravaListRoutes implements Tool
{
    public function __construct(
        private StravaService $service,
    ) {}

    public function name(): string
    {
        return 'strava_list_routes';
    }

    public function description(): string
    {
        return 'List routes created by a specific Strava athlete. Requires the athlete ID.';
    }

    public function parameters(): array
    {
        return [
            'athlete_id' => ['type' => 'integer', 'required' => true, 'description' => 'The athlete ID whose routes to list.'],
            'page' => ['type' => 'integer', 'description' => 'Page number (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of routes per page (default: 30).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Strava integration is not configured.');
            }

            if (!isset($args['athlete_id'])) {
                return ToolResult::error('Athlete ID is required.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 30;

            $result = $this->service->listRoutes((int) $args['athlete_id'], $page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
