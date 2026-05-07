<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

use OpenCompany\Integrations\RetellAI\RetellAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all configured voice agents.
 *
 * Returns all agents in the Retell AI account with their IDs,
 * names, voice configurations, and other settings.
 */
class RetellAIListAgents implements Tool
{
    /**
     * @param  RetellAIService  $service  The Retell AI API client.
     */
    public function __construct(
        private RetellAIService $service,
    ) {}

    public function name(): string
    {
        return 'retell_ai_list_agents';
    }

    public function description(): string
    {
        return 'List all configured voice agents in your Retell AI account. Returns agent IDs, names, voice settings, and other configuration details.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List voice agents.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
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
