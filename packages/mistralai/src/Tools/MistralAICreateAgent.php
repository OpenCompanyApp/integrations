<?php

namespace OpenCompany\Integrations\MistralAI\Tools;

use OpenCompany\Integrations\MistralAI\MistralAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for creating a new MistralAI agent.
 *
 * Creates a configurable AI agent with a name, model, and system instructions.
 * Agents can be used for persistent conversational AI with custom behaviors.
 */
class MistralAICreateAgent implements Tool
{
    /**
     * Create a new MistralAICreateAgent tool instance.
     */
    public function __construct(
        private MistralAIService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'mistralai_create_agent';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Create a new MistralAI agent. Specify a name, model, and instructions to define how the agent should behave. Agents are persistent AI assistants that can be used for conversations with custom personalities and capabilities.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The agent name (e.g., "Support Bot", "Code Assistant").'],
            'model' => ['type' => 'string', 'required' => true, 'description' => 'The model to use for the agent (e.g., "mistral-large-latest", "mistral-small-latest").'],
            'instructions' => ['type' => 'string', 'required' => true, 'description' => 'System instructions that define the agent\'s behavior, personality, and constraints.'],
            'description' => ['type' => 'string', 'description' => 'A short description of what the agent does.'],
        ];
    }

    /**
     * Execute the create agent request.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MistralAI integration is not configured.');
            }

            $name = $args['name'];
            $model = $args['model'];
            $instructions = $args['instructions'];

            $additionalParams = [];
            if (isset($args['description'])) {
                $additionalParams['description'] = $args['description'];
            }

            $result = $this->service->createAgent($name, $model, $instructions, $additionalParams);

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'name' => $result['name'] ?? $name,
                'description' => $result['description'] ?? ($args['description'] ?? ''),
                'model' => $result['model'] ?? $model,
                'instructions' => $result['instructions'] ?? $instructions,
                'created_at' => $result['created_at'] ?? null,
                'updated_at' => $result['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
