<?php

namespace OpenCompany\Integrations\Perplexity\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Perplexity\PerplexityService;

/**
 * Search the web with the Perplexity Search API.
 *
 * Returns relevant web page contents and metadata without generating a Sonar answer.
 */
class PerplexitySearch implements Tool
{
    /**
     * @param  PerplexityService  $service  The Perplexity API client.
     */
    public function __construct(
        private PerplexityService $service,
    ) {}

    public function name(): string
    {
        return 'perplexity_search';
    }

    public function description(): string
    {
        return 'Search the web with Perplexity Search API and return relevant page results. Use this when you need sources/content, not a generated answer.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query string or array of query strings.'],
            'country' => ['type' => 'string', 'description' => 'Optional ISO 3166-1 alpha-2 country code.'],
            'max_results' => ['type' => 'integer', 'description' => 'Maximum number of results to return, from 1 to 20.'],
            'max_tokens' => ['type' => 'integer', 'description' => 'Maximum total context tokens.'],
            'max_tokens_per_page' => ['type' => 'integer', 'description' => 'Maximum tokens per returned page.'],
            'search_language_filter' => ['type' => 'array', 'description' => 'ISO 639-1 language codes.'],
            'search_domain_filter' => ['type' => 'array', 'description' => 'Domains to limit search results to.'],
            'last_updated_after_filter' => ['type' => 'string', 'description' => 'Only return pages updated after this date in MM/DD/YYYY format.'],
            'last_updated_before_filter' => ['type' => 'string', 'description' => 'Only return pages updated before this date in MM/DD/YYYY format.'],
            'search_after_date_filter' => ['type' => 'string', 'description' => 'Only return pages published after this date in MM/DD/YYYY format.'],
            'search_before_date_filter' => ['type' => 'string', 'description' => 'Only return pages published before this date in MM/DD/YYYY format.'],
        ];
    }

    /**
     * Search the web with the configured Perplexity account.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Perplexity integration is not configured.');
            }

            if (empty($args['query'])) {
                return ToolResult::error('query is required.');
            }

            $payload = ['query' => $args['query']];

            foreach ([
                'country',
                'max_results',
                'max_tokens',
                'max_tokens_per_page',
                'search_language_filter',
                'search_domain_filter',
                'last_updated_after_filter',
                'last_updated_before_filter',
                'search_after_date_filter',
                'search_before_date_filter',
            ] as $key) {
                if (array_key_exists($key, $args)) {
                    $payload[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->search($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
