<?php

namespace OpenCompany\Integrations\Perplexity\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Perplexity\PerplexityService;

/**
 * Create Perplexity embeddings for one or more texts.
 */
class PerplexityEmbeddings implements Tool
{
    /**
     * @param  PerplexityService  $service  The Perplexity API client.
     */
    public function __construct(
        private PerplexityService $service,
    ) {}

    public function name(): string
    {
        return 'perplexity_embeddings';
    }

    public function description(): string
    {
        return 'Create Perplexity embeddings for a string or array of strings.';
    }

    public function parameters(): array
    {
        return [
            'input' => ['type' => 'string', 'required' => true, 'description' => 'Text string or array of text strings to embed.'],
            'model' => ['type' => 'string', 'description' => 'Embedding model. Defaults to "pplx-embed-v1-0.6b".'],
            'dimensions' => ['type' => 'integer', 'description' => 'Optional output dimensions.'],
            'encoding_format' => ['type' => 'string', 'description' => 'Embedding encoding format: "base64_int8" or "base64_binary".'],
        ];
    }

    /**
     * Create embeddings.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Perplexity integration is not configured.');
            }

            if (empty($args['input'])) {
                return ToolResult::error('input is required.');
            }

            $payload = [
                'input' => $args['input'],
                'model' => $args['model'] ?? 'pplx-embed-v1-0.6b',
            ];

            foreach (['dimensions', 'encoding_format'] as $key) {
                if (array_key_exists($key, $args)) {
                    $payload[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->embeddings($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
