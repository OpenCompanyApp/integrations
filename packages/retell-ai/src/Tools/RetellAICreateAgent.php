<?php

namespace OpenCompany\Integrations\RetellAI\Tools;

use OpenCompany\Integrations\RetellAI\RetellAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new voice AI agent.
 *
 * Creates a new agent with a specified voice and prompt.
 * Additional options can be passed to configure agent behavior.
 */
class RetellAICreateAgent implements Tool
{
    /**
     * @param  RetellAIService  $service  The Retell AI API client.
     */
    public function __construct(
        private RetellAIService $service,
    ) {}

    public function name(): string
    {
        return 'retell_ai_create_agent';
    }

    public function description(): string
    {
        return 'Create a new voice AI agent in Retell AI. Specify the voice ID and system prompt. Additional options like agent name, language, and behavior settings can be provided.';
    }

    public function parameters(): array
    {
        return [
            'voice_id' => ['type' => 'string', 'required' => true, 'description' => 'The voice ID to assign to the agent (e.g., "11labs_Alice"). Determines the voice the agent speaks with.'],
            'prompt' => ['type' => 'string', 'required' => true, 'description' => 'The system prompt that defines the agent\'s behavior, personality, and conversation guidelines.'],
            'options' => ['type' => 'object', 'description' => 'Additional agent configuration options (e.g., {"agent_name": "Support Agent", "language": "en", "ambient_noise": true}).'],
        ];
    }

    /**
     * Create a voice agent.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Retell AI integration is not configured.');
            }

            $voiceId = $args['voice_id'] ?? '';
            $prompt = $args['prompt'] ?? '';

            if (empty($voiceId)) {
                return ToolResult::error('voice_id is required.');
            }

            if (empty($prompt)) {
                return ToolResult::error('prompt is required.');
            }

            $options = is_array($args['options'] ?? null) ? $args['options'] : [];

            $result = $this->service->createAgent($voiceId, $prompt, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
