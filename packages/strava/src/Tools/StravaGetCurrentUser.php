<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\Integrations\Strava\StravaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class StravaGetCurrentUser implements Tool
{
    /**
     * @param  StravaService  $service  The Strava service instance.
     */
    public function __construct(
        private StravaService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'strava_get_current_user';
    }

    /**
     * A description of what this tool does, shown to AI agents.
     */
    public function description(): string
    {
        return 'Get the current authenticated user\'s Strava profile. This is an alias for strava_get_athlete — returns name, location, follower/following counts, and stats.';
    }

    /**
     * Parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
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
