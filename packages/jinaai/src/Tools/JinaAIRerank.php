<?php

namespace OpenCompany\Integrations\JinaAI\Tools;

use OpenCompany\Integrations\JinaAI\JinaAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * JinaAIRerank — Rerank documents by relevance to a query.
 *
 * Accepts a query and a list of documents, then returns the documents
 * sorted by relevance using Jina AI's Reranker endpoint.
 *
 * @see https://jina.ai/api/#reranker
 */
class JinaAIRerank implements Tool
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
        return 'jinaai_rerank';
    }

    /**
     * Human-readable description shown to AI agents.
     */
    public function description(): string
    {
        return 'Rerank documents by relevance to a query using Jina AI. Takes a query and a list of text documents, then returns them sorted by relevance with scores. Useful for improving search results or filtering the most relevant content.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'The query to rank documents against.'],
            'documents' => ['type' => 'array', 'required' => true, 'description' => 'An array of document strings to rank by relevance to the query.'],
            'model' => ['type' => 'string', 'description' => 'The reranking model to use (e.g., "jina-reranker-v2-base-multilingual"). Defaults to the Jina AI default model.'],
            'top_n' => ['type' => 'integer', 'description' => 'Maximum number of top results to return. Defaults to all documents.'],
        ];
    }

    /**
     * Execute the rerank tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (must contain 'query' and 'documents')
     * @return ToolResult The reranked documents with relevance scores
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Jina AI integration is not configured.');
            }

            $body = [
                'query' => $args['query'],
                'documents' => $args['documents'],
            ];

            if (isset($args['model'])) {
                $body['model'] = $args['model'];
            }

            if (isset($args['top_n'])) {
                $body['top_n'] = (int) $args['top_n'];
            }

            $result = $this->service->rerank($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
