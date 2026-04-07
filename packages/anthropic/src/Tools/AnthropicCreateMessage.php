<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

use OpenCompany\Integrations\Anthropic\AnthropicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new message (send a prompt to Claude).
 *
 * Sends a POST request to /messages with the model, messages,
 * and optional parameters like temperature and max_tokens.
 * Returns the generated message response.
 *
 * @see https://docs.anthropic.com/en/api/create-message
 */
class AnthropicCreateMessage implements Tool
{
    /**
     * @param  AnthropicService  $service  The Anthropic service instance.
     */
    public function __construct(
        private AnthropicService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'anthropic_create_message';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Send a prompt to Claude and receive an AI-generated response. Supports multi-turn conversations, system prompts, temperature control, and configurable output length.';
    }

    /**
     * Parameter schema for the create message request.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'The model to use (e.g., "claude-sonnet-4-20250514", "claude-haiku-4-20250414").'],
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of message objects with "role" ("user" or "assistant") and "content" (string or array of content blocks).'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum number of tokens to generate in the response (default: 4096).'],
            'system' => ['type' => 'string', 'description' => 'System prompt to set the behavior and context for Claude.'],
            'temperature' => ['type' => 'number', 'description' => 'Controls randomness in generation (0.0–1.0). Lower values are more deterministic.'],
            'top_p' => ['type' => 'number', 'description' => 'Nucleus sampling parameter (0.0–1.0). Limits cumulative probability of tokens considered.'],
            'stop_sequences' => ['type' => 'array', 'description' => 'Array of strings that will cause the model to stop generating if encountered.'],
            'stream' => ['type' => 'boolean', 'description' => 'Whether to stream the response incrementally (default: false).'],
        ];
    }

    /**
     * Execute the create message request.
     *
     * @param  array  $args  The message parameters.
     * @return ToolResult The generated message or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Anthropic integration is not configured.');
            }

            if (empty($args['model'])) {
                return ToolResult::error('Model is required.');
            }

            if (empty($args['messages'])) {
                return ToolResult::error('Messages are required.');
            }

            $options = [
                'model' => $args['model'],
                'messages' => $args['messages'],
            ];

            $optionalKeys = ['max_tokens', 'system', 'temperature', 'top_p', 'stop_sequences', 'stream'];

            foreach ($optionalKeys as $key) {
                if (isset($args[$key])) {
                    $options[$key] = $args[$key];
                }
            }

            $result = $this->service->createMessage($options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
