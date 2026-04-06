<?php

namespace OpenCompany\Integrations\Upstash\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Upstash\UpstashService;

/**
 * Tool to get current team information from Upstash.
 *
 * Calls GET /v2/teams on the Upstash Platform API
 * (https://api.upstash.com). Useful as a health check for the integration.
 */
class UpstashGetCurrentUser implements Tool
{
    /**
     * Create a new UpstashGetCurrentUser tool instance.
     */
    public function __construct(
        private UpstashService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'upstash_get_current_user';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get current team information from Upstash, including team name, members, and plan details.';
    }

    /**
     * Parameter schema for this tool.
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool: fetch team information.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Upstash integration is not configured.');
            }

            $team = $this->service->getTeamInfo();

            return ToolResult::success($team);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
