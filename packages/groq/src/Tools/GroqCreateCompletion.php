<?php

namespace OpenCompany\Integrations\Groq\Tools;

use OpenCompany\Integrations\Groq\GroqService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a chat completion using Groq's OpenAI-compatible endpoint.
 */
class GroqCreateCompletion implements Tool
{
    /**
     * @param  GroqService  $service  Groq API client.
     */
    public function __construct(
        private GroqService $service,
    ) {}

    public function name(): string
    {
        return 'groq_create_completion';
    }

    public function description(): string
    {
        return 'Create a chat completion using a Groq model. Send a list of messages and receive an AI-generated response with ultra-low latency. Supports configurable parameters like temperature, max_tokens, and top_p.';
    }

    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'The model ID to use (e.g., "llama-3.3-70b-versatile", "mixtral-8x7b-32768", "gemma2-9b-it").'],
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of message objects. Each message should have a "role" ("system", "user", or "assistant") and "content" string.'],
            'temperature' => ['type' => 'number', 'description' => 'Controls randomness in generation (0.0-2.0). Lower values are more deterministic, higher values more creative.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum number of tokens to generate in the response.'],
            'top_p' => ['type' => 'number', 'description' => 'Nucleus sampling parameter (0.0-1.0). Limits cumulative probability of tokens considered.'],
            'stream' => ['type' => 'boolean', 'description' => 'Whether to stream the response. Defaults to false.'],
        ];
    }

    /**
     * Execute the chat completion request.
     *
     * @param  array<string, mixed>  $args  Chat completion arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Groq integration is not configured.');
            }

            if (empty($args['model'])) {
                return ToolResult::error('Model is required.');
            }

            if (empty($args['messages'])) {
                return ToolResult::error('Messages are required.');
            }

            $options = [];
            if (isset($args['temperature'])) {
                $options['temperature'] = (float) $args['temperature'];
            }
            if (isset($args['max_tokens'])) {
                $options['max_tokens'] = (int) $args['max_tokens'];
            }
            if (isset($args['top_p'])) {
                $options['top_p'] = (float) $args['top_p'];
            }
            if (isset($args['stream'])) {
                $options['stream'] = (bool) $args['stream'];
            }

            $result = $this->service->createCompletion(
                $args['model'],
                $args['messages'],
                $options,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
