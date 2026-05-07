<?php

namespace OpenCompany\Integrations\Perplexity\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Perplexity\PerplexityService;

/**
 * Create contextualized Perplexity embeddings for grouped document chunks.
 */
class PerplexityContextualizedEmbeddings implements Tool
{
    /**
     * @param  PerplexityService  $service  The Perplexity API client.
     */
    public function __construct(
        private PerplexityService $service,
    ) {}

    public function name(): string
    {
        return 'perplexity_contextualized_embeddings';
    }

    public function description(): string
    {
        return 'Create contextualized embeddings for document chunks grouped by source document.';
    }

    public function parameters(): array
    {
        return [
            'input' => ['type' => 'array', 'required' => true, 'description' => 'Nested array where each inner array contains chunks from one document.'],
            'model' => ['type' => 'string', 'description' => 'Contextualized embedding model. Defaults to "pplx-embed-context-v1-0.6b".'],
            'dimensions' => ['type' => 'integer', 'description' => 'Optional output dimensions.'],
            'encoding_format' => ['type' => 'string', 'description' => 'Embedding encoding format: "base64_int8" or "base64_binary".'],
        ];
    }

    /**
     * Create contextualized embeddings.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Perplexity integration is not configured.');
            }

            if (empty($args['input']) || ! is_array($args['input'])) {
                return ToolResult::error('input must be a non-empty nested array of document chunks.');
            }

            $payload = [
                'input' => $args['input'],
                'model' => $args['model'] ?? 'pplx-embed-context-v1-0.6b',
            ];

            foreach (['dimensions', 'encoding_format'] as $key) {
                if (array_key_exists($key, $args)) {
                    $payload[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->contextualizedEmbeddings($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
