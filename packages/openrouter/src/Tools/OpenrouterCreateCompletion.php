<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

use OpenCompany\Integrations\Openrouter\OpenrouterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a chat completion using OpenRouter.
 *
 * Sends a POST request to /chat/completions with the model, messages,
 * and optional parameters like temperature and max_tokens.
 * Returns the generated completion response.
 *
 * @see https://openrouter.ai/docs/api-reference/create-completion
 */
class OpenrouterCreateCompletion implements Tool
{
    /**
     * @param  OpenrouterService  $service  The OpenRouter service instance.
     */
    public function __construct(
        private OpenrouterService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'openrouter_create_completion';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a chat completion using any model available on OpenRouter. Supports multi-turn conversations, system prompts, temperature control, and configurable output length.';
    }

    /**
     * Parameter schema for the create completion request.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'The model to use (e.g., "openai/gpt-4o", "anthropic/claude-3.5-sonnet", "meta-llama/llama-3-70b-instruct").'],
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of message objects with "role" ("system", "user", or "assistant") and "content" (string).'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum number of tokens to generate in the response.'],
            'temperature' => ['type' => 'number', 'description' => 'Controls randomness in generation (0.0–2.0). Lower values are more deterministic.'],
            'top_p' => ['type' => 'number', 'description' => 'Nucleus sampling parameter (0.0–1.0). Limits cumulative probability of tokens considered.'],
            'stop' => ['type' => 'array', 'description' => 'Array of strings that will cause the model to stop generating if encountered.'],
            'stream' => ['type' => 'boolean', 'description' => 'Whether to stream the response incrementally (default: false).'],
        ];
    }

    /**
     * Execute the create completion request.
     *
     * @param  array  $args  The completion parameters.
     * @return ToolResult The generated completion or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OpenRouter integration is not configured.');
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

            $optionalKeys = ['max_tokens', 'temperature', 'top_p', 'stop', 'stream'];

            foreach ($optionalKeys as $key) {
                if (isset($args[$key])) {
                    $options[$key] = $args[$key];
                }
            }

            $result = $this->service->createCompletion($options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
