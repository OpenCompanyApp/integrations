<?php

namespace OpenCompany\Integrations\Retell\Tools;

use OpenCompany\Integrations\Retell\RetellService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: retell_list_agents
 *
 * List all AI voice agents from Retell AI.
 *
 * @see https://docs.retellai.com/api-reference/list-agents
 */
class RetellListAgents implements Tool
{
    /**
     * Create a new RetellListAgents tool instance.
     */
    public function __construct(
        private RetellService $service,
    ) {}

    /**
     * The tool identifier used for registration and routing.
     */
    public function name(): string
    {
        return 'retell_list_agents';
    }

    /**
     * Human-readable description shown to AI agents and in tool listings.
     */
    public function description(): string
    {
        return 'List all AI voice agents configured in Retell AI. Returns agent IDs, names, and configuration details.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list-agents tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Retell AI integration is not configured.');
            }

            $result = $this->service->listAgents();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
