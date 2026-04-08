<?php

namespace OpenCompany\Integrations\Opsgenie\Tools;

use OpenCompany\Integrations\Opsgenie\OpsgenieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list all Opsgenie teams.
 *
 * Returns team IDs, names, and descriptions for all teams the API key
 * has access to.
 */
class OpsgenieListTeams implements Tool
{
    /**
     * Create a new OpsgenieListTeams tool instance.
     *
     * @param  OpsgenieService  $service  The Opsgenie API service
     */
    public function __construct(
        private OpsgenieService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'opsgenie_list_teams';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List all Opsgenie teams. Returns team IDs, names, and descriptions.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the list of teams.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Opsgenie integration is not configured.');
            }

            $result = $this->service->listTeams();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
