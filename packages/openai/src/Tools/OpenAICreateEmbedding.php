<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Generate an embedding vector for text input.
 *
 * Creates a numerical representation of the input text using
 * OpenAI embedding models such as text-embedding-3-small.
 */
class OpenAICreateEmbedding implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_create_embedding';
    }

    public function description(): string
    {
        return 'Generate an embedding vector for text input using OpenAI embedding models.';
    }

    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Embedding model ID (e.g., "text-embedding-3-small", "text-embedding-3-large").'],
            'input' => ['type' => 'string', 'required' => true, 'description' => 'Text string or array of strings to embed.'],
        ];
    }

    /**
     * Generate an embedding vector.
     *
     * @param  array<string, mixed>  $args  Tool arguments (model, input)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $model = $args['model'] ?? '';
            $input = $args['input'] ?? '';

            if (empty($model)) {
                return ToolResult::error('model is required.');
            }
            if (empty($input)) {
                return ToolResult::error('input is required.');
            }

            $result = $this->service->createEmbedding([
                'model' => $model,
                'input' => $input,
            ]);

            return ToolResult::success([
                'object' => $result['object'] ?? '',
                'model' => $result['model'] ?? $model,
                'data' => $result['data'] ?? [],
                'usage' => $result['usage'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
