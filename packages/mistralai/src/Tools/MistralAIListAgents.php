<?php

namespace OpenCompany\Integrations\MistralAI\Tools;

use OpenCompany\Integrations\MistralAI\MistralAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing MistralAI agents.
 *
 * Retrieves all agents available in the authenticated MistralAI account.
 * Agents are configurable AI assistants with custom instructions and tools.
 */
class MistralAIListAgents implements Tool
{
    /**
     * Create a new MistralAIListAgents tool instance.
     */
    public function __construct(
        private MistralAIService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'mistralai_list_agents';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List all MistralAI agents in your account. Returns agent IDs, names, models, and descriptions. Agents are AI assistants with custom instructions and tools.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list agents request.
     *
     * @param  array<string, mixed>  $args  The tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MistralAI integration is not configured.');
            }

            $result = $this->service->listAgents();

            $agents = $result['data'] ?? [];

            $response = [
                'agents' => array_map(function (array $agent): array {
                    return [
                        'id' => $agent['id'] ?? '',
                        'name' => $agent['name'] ?? '',
                        'description' => $agent['description'] ?? '',
                        'model' => $agent['model'] ?? '',
                        'created_at' => $agent['created_at'] ?? null,
                        'updated_at' => $agent['updated_at'] ?? null,
                    ];
                }, $agents),
                'total' => count($agents),
            ];

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
