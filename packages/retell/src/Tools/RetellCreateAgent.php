<?php

namespace OpenCompany\Integrations\Retell\Tools;

use OpenCompany\Integrations\Retell\RetellService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: retell_create_agent
 *
 * Create a new AI voice agent in Retell AI.
 *
 * @see https://docs.retellai.com/api-reference/create-agent
 */
class RetellCreateAgent implements Tool
{
    /**
     * Create a new RetellCreateAgent tool instance.
     */
    public function __construct(
        private RetellService $service,
    ) {}

    /**
     * The tool identifier used for registration and routing.
     */
    public function name(): string
    {
        return 'retell_create_agent';
    }

    /**
     * Human-readable description shown to AI agents and in tool listings.
     */
    public function description(): string
    {
        return 'Create a new AI voice agent in Retell AI. Configure the model, voice, system prompt, and response engine.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'description' => 'The LLM model to use (e.g., "gpt-4o", "gpt-4o-mini", "claude-3.5-sonnet").'],
            'voice_id' => ['type' => 'string', 'description' => 'The voice ID to use for the agent. Browse available voices in the Retell AI dashboard.'],
            'prompt' => ['type' => 'string', 'description' => 'The system prompt that defines the agent\'s behavior and personality.'],
            'response_engine' => ['type' => 'object', 'description' => 'Response engine configuration. Pass as a JSON object (e.g., {"type": "retell-llm", "llm_url": "..."}).'],
        ];
    }

    /**
     * Execute the create-agent tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Retell AI integration is not configured.');
            }

            $responseEngine = null;
            if (isset($args['response_engine'])) {
                $responseEngine = is_string($args['response_engine'])
                    ? json_decode($args['response_engine'], true)
                    : $args['response_engine'];
            }

            $result = $this->service->createAgent(
                model: $args['model'] ?? null,
                voiceId: $args['voice_id'] ?? null,
                prompt: $args['prompt'] ?? null,
                responseEngine: $responseEngine,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
