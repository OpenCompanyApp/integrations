<?php

namespace OpenCompany\Integrations\MistralAI\Tools;

use OpenCompany\Integrations\MistralAI\MistralAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for generating chat completions using MistralAI models.
 *
 * Sends a conversation to a MistralAI model and returns the generated response.
 * Supports multi-turn conversations via the messages array and configurable
 * sampling temperature.
 */
class MistralAIChat implements Tool
{
    /**
     * Create a new MistralAIChat tool instance.
     */
    public function __construct(
        private MistralAIService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'mistralai_chat';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Generate a chat completion using a MistralAI model. Send a list of messages (with roles "system", "user", or "assistant") and receive a model-generated response. Use temperature to control creativity (0 = deterministic, 1 = creative).';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'The model to use (e.g., "mistral-large-latest", "mistral-small-latest", "open-mistral-nemo").'],
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of message objects with "role" (system, user, assistant) and "content" fields. Example: [{"role": "user", "content": "Hello"}]'],
            'temperature' => ['type' => 'number', 'description' => 'Sampling temperature between 0.0 and 1.0. Lower values are more deterministic, higher values more creative. Default: 0.7.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum number of tokens to generate in the response.'],
        ];
    }

    /**
     * Execute the chat completion request.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MistralAI integration is not configured.');
            }

            $model = $args['model'];
            $messages = $args['messages'];
            $temperature = isset($args['temperature']) ? (float) $args['temperature'] : null;
            $maxTokens = isset($args['max_tokens']) ? (int) $args['max_tokens'] : null;

            if (!is_array($messages) || empty($messages)) {
                return ToolResult::error('messages must be a non-empty array of message objects.');
            }

            $result = $this->service->chat($model, $messages, $temperature, $maxTokens);

            $choices = $result['choices'] ?? [];
            $usage = $result['usage'] ?? [];

            $response = [
                'model' => $result['model'] ?? $model,
                'id' => $result['id'] ?? null,
            ];

            if (!empty($choices)) {
                $response['choices'] = array_map(function (array $choice): array {
                    return [
                        'index' => $choice['index'] ?? 0,
                        'role' => $choice['message']['role'] ?? 'assistant',
                        'content' => $choice['message']['content'] ?? '',
                        'finish_reason' => $choice['finish_reason'] ?? null,
                    ];
                }, $choices);
            }

            if (!empty($usage)) {
                $response['usage'] = [
                    'prompt_tokens' => $usage['prompt_tokens'] ?? 0,
                    'completion_tokens' => $usage['completion_tokens'] ?? 0,
                    'total_tokens' => $usage['total_tokens'] ?? 0,
                ];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
