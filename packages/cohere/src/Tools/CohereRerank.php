<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Rerank documents for a query with Cohere v2 Rerank.
 *
 * Returns relevance scores and original document indexes in ranked order.
 */
class CohereRerank extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_rerank';
    }

    public function description(): string
    {
        return 'Rerank a list of documents for a search query using Cohere v2 Rerank. Documents may be strings; structured data should be converted to YAML strings before calling.';
    }

    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Rerank model ID, for example rerank-v4.0-pro.'],
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query.'],
            'documents' => ['type' => 'array', 'required' => true, 'items' => ['type' => 'string'], 'description' => 'Documents to compare to the query. Cohere recommends no more than 1000 per call.'],
            'top_n' => ['type' => 'integer', 'description' => 'Maximum number of ranked results to return.'],
            'max_tokens_per_doc' => ['type' => 'integer', 'description' => 'Token truncation limit per document. Defaults to 4096 upstream.'],
            'priority' => ['type' => 'integer', 'description' => 'Priority from 0 to 999, where lower values are handled earlier.'],
        ];
    }

    /**
     * Execute the Cohere Rerank API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching Cohere v2 Rerank parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            $payload = $this->only($args, ['model', 'query', 'documents', 'top_n', 'max_tokens_per_doc', 'priority']);
            $payload['model'] = $this->requireString($args, 'model');
            $payload['query'] = $this->requireString($args, 'query');
            $payload['documents'] = $this->requireStringList($args, 'documents');

            return ToolResult::success($this->service->rerank($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
