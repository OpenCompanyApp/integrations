<?php

namespace OpenCompany\Integrations\AssemblyAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;

/**
 * Create a chat completion through AssemblyAI LLM Gateway.
 */
class AssemblyAILlmGatewayChat implements Tool
{
    /**
     * @param  AssemblyAIService  $service  The AssemblyAI API client.
     */
    public function __construct(private AssemblyAIService $service) {}

    public function name(): string
    {
        return 'assemblyai_llm_gateway_chat';
    }

    public function description(): string
    {
        return 'Create a chat completion through AssemblyAI LLM Gateway using a prompt or message list.';
    }

    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'LLM Gateway model id.'],
            'messages' => ['type' => 'array', 'description' => 'Conversation messages. Either messages or prompt is required.'],
            'prompt' => ['type' => 'string', 'description' => 'Simple single-turn prompt. Either prompt or messages is required.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum output tokens. Defaults to 1000 upstream.'],
            'temperature' => ['type' => 'number', 'description' => 'Sampling temperature.'],
            'tools' => ['type' => 'array', 'description' => 'Optional tool/function definitions.'],
            'tool_choice' => ['type' => 'object', 'description' => 'Optional tool choice control.'],
            'response_format' => ['type' => 'object', 'description' => 'Optional structured output format.'],
            'fallbacks' => ['type' => 'array', 'description' => 'Optional fallback model configs.'],
            'fallback_config' => ['type' => 'object', 'description' => 'Optional fallback behavior config.'],
        ];
    }

    /**
     * Create an LLM Gateway chat completion.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('AssemblyAI integration is not configured.');
            }

            if (empty($args['model'])) {
                return ToolResult::error('model is required.');
            }

            if (empty($args['messages']) && empty($args['prompt'])) {
                return ToolResult::error('Either messages or prompt is required.');
            }

            return ToolResult::success($this->service->chatCompletion($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
