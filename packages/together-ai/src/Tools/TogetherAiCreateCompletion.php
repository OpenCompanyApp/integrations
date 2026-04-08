<?php

namespace OpenCompany\Integrations\TogetherAi\Tools;

use OpenCompany\Integrations\TogetherAi\TogetherAiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a chat completion using Together AI.
 *
 * Supports chat completions with messages, temperature, max_tokens,
 * and other parameters compatible with the OpenAI-style API.
 */
class TogetherAiCreateCompletion implements Tool
{
    public function __construct(
        private TogetherAiService $service,
    ) {}

    public function name(): string
    {
        return 'togetherai_create_completion';
    }

    public function description(): string
    {
        return 'Create a chat completion using a Together AI model. Send a conversation with messages and receive a generated response. Supports models like Llama, Mixtral, Qwen, DBRX, and more.';
    }

    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'The model ID to use (e.g. "meta-llama/Llama-3.3-70B-Instruct-Turbo", "mistralai/Mixtral-8x7B-Instruct-v0.1").'],
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of message objects with "role" (system, user, assistant) and "content" fields.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum number of tokens to generate in the response.'],
            'temperature' => ['type' => 'number', 'description' => 'Sampling temperature (0.0–2.0). Higher values increase randomness. Defaults to 0.7.'],
            'top_p' => ['type' => 'number', 'description' => 'Nucleus sampling threshold (0.0–1.0). Defaults to 0.7.'],
            'top_k' => ['type' => 'integer', 'description' => 'Top-k sampling parameter. Limits tokens considered at each step.'],
            'frequency_penalty' => ['type' => 'number', 'description' => 'Penalize tokens based on frequency (-2.0 to 2.0).'],
            'presence_penalty' => ['type' => 'number', 'description' => 'Penalize tokens based on presence (-2.0 to 2.0).'],
            'stop' => ['type' => 'array', 'description' => 'Array of stop sequences. Generation stops when any sequence is encountered.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Together AI integration is not configured.');
            }

            if (empty($args['model'])) {
                return ToolResult::error('model is required.');
            }

            if (empty($args['messages'])) {
                return ToolResult::error('messages is required.');
            }

            $payload = [
                'model' => $args['model'],
                'messages' => $args['messages'],
            ];

            if (isset($args['max_tokens'])) {
                $payload['max_tokens'] = (int) $args['max_tokens'];
            }
            if (isset($args['temperature'])) {
                $payload['temperature'] = (float) $args['temperature'];
            }
            if (isset($args['top_p'])) {
                $payload['top_p'] = (float) $args['top_p'];
            }
            if (isset($args['top_k'])) {
                $payload['top_k'] = (int) $args['top_k'];
            }
            if (isset($args['frequency_penalty'])) {
                $payload['frequency_penalty'] = (float) $args['frequency_penalty'];
            }
            if (isset($args['presence_penalty'])) {
                $payload['presence_penalty'] = (float) $args['presence_penalty'];
            }
            if (isset($args['stop'])) {
                $payload['stop'] = $args['stop'];
            }

            $result = $this->service->createCompletion($payload);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
