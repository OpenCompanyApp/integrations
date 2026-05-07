<?php

namespace OpenCompany\Integrations\JinaAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\JinaAI\JinaAIService;

/**
 * Segment or tokenize text with Jina AI Segmenter.
 */
class JinaAISegment implements Tool
{
    /**
     * @param  JinaAIService  $service  The Jina AI API client.
     */
    public function __construct(
        private JinaAIService $service,
    ) {}

    public function name(): string
    {
        return 'jinaai_segment';
    }

    public function description(): string
    {
        return 'Tokenize or segment long text using Jina AI Segmenter before embedding, reranking, or LLM processing.';
    }

    public function parameters(): array
    {
        return [
            'content' => ['type' => 'string', 'required' => true, 'description' => 'Text content to tokenize or segment.'],
            'tokenizer' => ['type' => 'string', 'description' => 'Tokenizer or model-compatible tokenizer to use.'],
            'return_tokens' => ['type' => 'boolean', 'description' => 'Whether to include token text in the response.'],
            'return_chunks' => ['type' => 'boolean', 'description' => 'Whether to include segmented chunks in the response.'],
            'max_chunk_length' => ['type' => 'integer', 'description' => 'Maximum chunk length when chunking is enabled.'],
        ];
    }

    /**
     * Segment text with the configured Jina AI account.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Jina AI integration is not configured.');
            }

            $content = $args['content'] ?? null;
            if (! is_string($content) || $content === '') {
                return ToolResult::error('content must be a non-empty string.');
            }

            $body = ['content' => $content];
            foreach (['tokenizer', 'return_tokens', 'return_chunks', 'max_chunk_length'] as $key) {
                if (array_key_exists($key, $args)) {
                    $body[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->segment($body));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
