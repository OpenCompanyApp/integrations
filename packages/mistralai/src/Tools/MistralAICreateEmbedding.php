<?php

namespace OpenCompany\Integrations\MistralAI\Tools;

use OpenCompany\Integrations\MistralAI\MistralAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for generating text embeddings using MistralAI embedding models.
 *
 * Converts text input into high-dimensional vector representations that can
 * be used for semantic search, clustering, classification, and other NLP tasks.
 */
class MistralAICreateEmbedding implements Tool
{
    /**
     * Create a new MistralAICreateEmbedding tool instance.
     */
    public function __construct(
        private MistralAIService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'mistralai_create_embedding';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Generate text embeddings using a MistralAI embedding model. Converts text into numerical vectors for semantic search, similarity comparison, or clustering. Supports single strings or arrays of strings.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'The embedding model to use (e.g., "mistral-embed").'],
            'input' => ['type' => 'string', 'required' => true, 'description' => 'The text to embed. Can be a single string or JSON array of strings for batch embedding.'],
        ];
    }

    /**
     * Execute the embedding request.
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
            $input = $args['input'];

            // Support JSON-encoded arrays passed as string
            if (is_string($input) && str_starts_with(trim($input), '[')) {
                $decoded = json_decode($input, true);
                if (is_array($decoded)) {
                    $input = $decoded;
                }
            }

            $result = $this->service->createEmbedding($model, $input);

            $data = $result['data'] ?? [];
            $usage = $result['usage'] ?? [];

            $response = [
                'model' => $result['model'] ?? $model,
                'embeddings' => array_map(function (array $item): array {
                    return [
                        'index' => $item['index'] ?? 0,
                        'embedding' => $item['object'] ?? 'embedding',
                        'dimensions' => count($item['embedding'] ?? []),
                    ];
                }, $data),
                'embeddingCount' => count($data),
            ];

            if (!empty($usage)) {
                $response['usage'] = [
                    'prompt_tokens' => $usage['prompt_tokens'] ?? 0,
                    'total_tokens' => $usage['total_tokens'] ?? 0,
                ];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
