<?php

namespace OpenCompany\Integrations\JinaAI\Tools;

use OpenCompany\Integrations\JinaAI\JinaAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * JinaAIEmbeddings — Generate text embeddings using Jina AI.
 *
 * Accepts text input(s) and returns vector embeddings via Jina AI's
 * Embeddings endpoint.
 *
 * @see https://jina.ai/api/#embeddings
 */
class JinaAIEmbeddings implements Tool
{
    /**
     * @param  JinaAIService  $service  The Jina AI service instance
     */
    public function __construct(
        private JinaAIService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'jinaai_embeddings';
    }

    /**
     * Human-readable description shown to AI agents.
     */
    public function description(): string
    {
        return 'Generate text embeddings using Jina AI. Converts text into dense vector representations useful for semantic search, similarity comparison, clustering, and retrieval-augmented generation (RAG).';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'input' => ['type' => 'array', 'required' => true, 'description' => 'An array of strings to generate embeddings for. Each string is embedded independently.'],
            'model' => ['type' => 'string', 'description' => 'The embedding model to use (e.g., "jina-embeddings-v3"). Defaults to the Jina AI default model.'],
        ];
    }

    /**
     * Execute the embeddings tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (must contain 'input')
     * @return ToolResult The embedding results with vectors
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Jina AI integration is not configured.');
            }

            $body = [
                'input' => $args['input'],
            ];

            if (isset($args['model'])) {
                $body['model'] = $args['model'];
            }

            $result = $this->service->embeddings($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
