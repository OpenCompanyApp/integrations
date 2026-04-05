<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\Integrations\Strava\StravaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StravaGetCurrentUser implements Tool
{
    public function __construct(
        private StravaService $service,
    ) {}

    public function name(): string
    {
        return 'strava_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Strava athlete\'s profile. Returns name, location, follower/following counts, and profile info.';
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

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
