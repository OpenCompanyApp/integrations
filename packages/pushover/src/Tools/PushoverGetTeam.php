<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Show Pushover team information and member devices.
 */
class PushoverGetTeam implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_get_team';
    }

    public function description(): string
    {
        return 'Show Pushover team information and users. Requires the optional team_token credential.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get Pushover team information.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isTeamConfigured()) {
                return ToolResult::error('Pushover team_token credential is not configured.');
            }

            return ToolResult::success($this->service->getTeam());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
