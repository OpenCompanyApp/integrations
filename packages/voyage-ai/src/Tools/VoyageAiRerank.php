<?php

namespace OpenCompany\Integrations\VoyageAi\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Rerank documents for a query with Voyage AI.
 *
 * Returns Voyage's native ranking response with indices, relevance scores,
 * and optionally the original documents.
 */
class VoyageAiRerank extends AbstractVoyageAiTool implements Tool
{
    public function name(): string
    {
        return 'voyage_ai_rerank';
    }

    public function description(): string
    {
        return 'Rerank documents for a query using Voyage AI cross-encoder rerankers. Use after lexical or vector retrieval to improve final context quality.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Query to rank documents against.'],
            'documents' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'string'], 'description' => 'Documents to rerank. Maximum 1,000 documents.'],
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Reranker model. Recommended: rerank-2.5 or rerank-2.5-lite.'],
            'top_k' => ['type' => 'integer', 'description' => 'Number of most relevant documents to return.'],
            'return_documents' => ['type' => 'boolean', 'description' => 'Whether to include source documents in the response.'],
            'truncation' => ['type' => 'boolean', 'description' => 'Whether to truncate inputs to fit model context. Defaults to true upstream.'],
        ];
    }

    /**
     * Execute the reranker API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching the Voyage rerank request.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Voyage AI integration is not configured.');
            }

            $payload = $this->only($args, ['query', 'documents', 'model', 'top_k', 'return_documents', 'truncation']);
            $payload['query'] = $this->requireString($args, 'query');
            $payload['documents'] = $this->requireArray($args, 'documents');
            $payload['model'] = $this->requireString($args, 'model');

            return ToolResult::success($this->service->rerank($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
