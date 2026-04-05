<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\Integrations\Strava\StravaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StravaGetAthlete implements Tool
{
    public function __construct(
        private StravaService $service,
    ) {}

    public function name(): string
    {
        return 'strava_get_athlete';
    }

    public function description(): string
    {
        return 'Get the authenticated Strava athlete\'s profile, including name, location, and follower/following counts.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Strava integration is not configured.');
            }

            $result = $this->service->getAthlete();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
