<?php

namespace OpenCompany\Integrations\Perplexity\Tools;

use OpenCompany\Integrations\Perplexity\PerplexityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Ask a single Perplexity Sonar question.
 *
 * Provides a compact wrapper around the Sonar chat endpoint for one-shot questions.
 */
class PerplexityAsk implements Tool
{
    /**
     * @param  PerplexityService  $service  The Perplexity API client.
     */
    public function __construct(
        private PerplexityService $service,
    ) {}

    public function name(): string
    {
        return 'perplexity_ask';
    }

    public function description(): string
    {
        return 'Ask Perplexity a one-shot question through the Sonar chat endpoint and get an answer with citations and optional search metadata.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'The question or prompt to ask Perplexity AI.'],
            'model' => ['type' => 'string', 'description' => 'Sonar model to use. Common values: "sonar", "sonar-pro", "sonar-deep-research", "sonar-reasoning-pro". Defaults to "sonar".'],
            'temperature' => ['type' => 'number', 'description' => 'Sampling temperature (0.0–2.0). Lower values are more focused. Defaults to 0.2.'],
            'top_p' => ['type' => 'number', 'description' => 'Nucleus sampling value between 0 and 1.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum number of tokens in the response.'],
            'response_format' => ['type' => 'object', 'description' => 'Optional response format object, including JSON schema formats supported by Sonar.'],
            'web_search_options' => ['type' => 'object', 'description' => 'Current Perplexity web search options object. Use this for advanced search/image/date filters.'],
            'search_mode' => ['type' => 'string', 'description' => 'Convenience web search option: "web", "academic", or "sec".'],
            'search_domain_filter' => ['type' => 'array', 'description' => 'List of domains to limit search results to (e.g., ["wikipedia.org"]).'],
            'search_language_filter' => ['type' => 'array', 'description' => 'Convenience web search option: ISO 639-1 language codes.'],
            'return_images' => ['type' => 'boolean', 'description' => 'Whether to return images in the response. Defaults to false.'],
            'return_related_questions' => ['type' => 'boolean', 'description' => 'Whether to return related questions. Defaults to false.'],
            'search_recency_filter' => ['type' => 'string', 'description' => 'Filter search results by recency: "hour", "day", "week", "month", or "year".'],
            'disable_search' => ['type' => 'boolean', 'description' => 'Convenience web search option: disable web search.'],
            'reasoning_effort' => ['type' => 'string', 'description' => 'Reasoning effort for supported models: "minimal", "low", "medium", or "high".'],
            'language_preference' => ['type' => 'string', 'description' => 'Preferred response language as an ISO 639-1 code.'],
        ];
    }

    /**
     * Ask a one-shot Sonar question.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Perplexity integration is not configured.');
            }

            $query = $args['query'] ?? null;

            if (empty($query) || !is_string($query)) {
                return ToolResult::error('query must be a non-empty string.');
            }

            $options = $this->buildOptions($args);

            $result = $this->service->ask($query, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Build Sonar request options from one-shot question arguments.
     *
     * @param  array<string, mixed>  $args
     * @return array<string, mixed>
     */
    private function buildOptions(array $args): array
    {
        $options = [];

        foreach (['model', 'temperature', 'top_p', 'max_tokens', 'response_format', 'reasoning_effort', 'language_preference'] as $key) {
            if (array_key_exists($key, $args)) {
                $options[$key] = $args[$key];
            }
        }

        $webSearchOptions = $args['web_search_options'] ?? [];
        foreach (['search_mode', 'search_domain_filter', 'search_language_filter', 'return_images', 'return_related_questions', 'search_recency_filter', 'disable_search'] as $key) {
            if (array_key_exists($key, $args)) {
                $webSearchOptions[$key] = $args[$key];
            }
        }

        if ($webSearchOptions !== []) {
            $options['web_search_options'] = $webSearchOptions;
        }

        return $options;
    }
}
