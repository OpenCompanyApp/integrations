<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generate a chat completion using GPT models.
 *
 * Sends a list of messages and returns the model's response.
 * Supports temperature, max_tokens, and JSON response format.
 */
class OpenAIChatCompletion implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_chat_completion';
    }

    public function description(): string
    {
        return 'Generate a chat completion using OpenAI GPT models. Send a conversation as an array of messages with role and content.';
    }

    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Model ID (e.g., "gpt-4o", "gpt-4o-mini", "gpt-4-turbo").'],
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of message objects, each with "role" (system, user, assistant) and "content".', 'items' => ['type' => 'object']],
            'temperature' => ['type' => 'number', 'description' => 'Sampling temperature between 0 and 2. Higher values produce more random output.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum number of tokens to generate in the response.'],
            'top_p' => ['type' => 'number', 'description' => 'Nucleus sampling parameter. Use temperature or top_p, but not both.'],
            'frequency_penalty' => ['type' => 'number', 'description' => 'Penalty for frequent tokens (-2.0 to 2.0).'],
            'presence_penalty' => ['type' => 'number', 'description' => 'Penalty for new tokens (-2.0 to 2.0).'],
            'response_format' => ['type' => 'object', 'description' => 'Response format, e.g. {"type": "json_object"} for JSON output.'],
        ];
    }

    /**
     * Generate a chat completion response.
     *
     * @param  array<string, mixed>  $args  Tool arguments (model, messages, temperature, etc.)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $model = $args['model'] ?? '';
            $messages = $args['messages'] ?? [];

            if (empty($model)) {
                return ToolResult::error('model is required.');
            }
            if (empty($messages)) {
                return ToolResult::error('messages is required.');
            }

            $data = [
                'model' => $model,
                'messages' => $messages,
                'stream' => false,
            ];

            if (isset($args['temperature'])) {
                $data['temperature'] = (float) $args['temperature'];
            }
            if (isset($args['max_tokens'])) {
                $data['max_tokens'] = (int) $args['max_tokens'];
            }
            if (isset($args['top_p'])) {
                $data['top_p'] = (float) $args['top_p'];
            }
            if (isset($args['frequency_penalty'])) {
                $data['frequency_penalty'] = (float) $args['frequency_penalty'];
            }
            if (isset($args['presence_penalty'])) {
                $data['presence_penalty'] = (float) $args['presence_penalty'];
            }
            if (isset($args['response_format'])) {
                $data['response_format'] = $args['response_format'];
            }

            $result = $this->service->chatCompletion($data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'model' => $result['model'] ?? $model,
                'choices' => $result['choices'] ?? [],
                'usage' => $result['usage'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
