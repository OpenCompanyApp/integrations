<?php

namespace OpenCompany\Integrations\Exa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Exa\ExaService;

/**
 * Perform a neural search query across the web using Exa AI.
 *
 * Supports natural language queries with optional filters for category,
 * date range, and autoprompt mode. Returns a list of matching documents
 * with titles, URLs, and relevance scores.
 */
class ExaSearch implements Tool
{
    public function __construct(
        private ExaService $service,
    ) {}

    public function name(): string
    {
        return 'exa_search';
    }

    public function description(): string
    {
        return 'Perform a neural search query across the web using Exa AI. Returns a list of relevant pages with titles, URLs, and scores. Supports filtering by category, date range, and autoprompt mode.';
    }

    public function parameters(): array
    {
        return [
            'query' => [
                'type' => 'string',
                'required' => true,
                'description' => 'Natural language search query. Describe the type of content you want to find.',
            ],
            'num_results' => [
                'type' => 'integer',
                'description' => 'Number of results to return (default: 10, max: 100).',
            ],
            'use_autoprompt' => [
                'type' => 'boolean',
                'description' => 'Let Exa automatically optimize your query for better results (default: true).',
            ],
            'type' => [
                'type' => 'string',
                'enum' => ['keyword', 'neural', 'auto'],
                'description' => 'Search type: "keyword" for exact matches, "neural" for semantic search, "auto" to let Exa decide (default: "auto").',
            ],
            'category' => [
                'type' => 'string',
                'enum' => ['company', 'research paper', 'news', 'github', 'tweet', 'movie', 'song', 'personal site', 'or pdf'],
                'description' => 'Filter results to a specific category of content.',
            ],
            'start_published_date' => [
                'type' => 'string',
                'description' => 'Only return results published after this date (ISO 8601, e.g., "2024-01-01T00:00:00Z").',
            ],
        ];
    }

    /**
     * Execute the search query.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Exa integration is not configured.');
            }

            $body = [
                'query' => $args['query'],
            ];

            if (isset($args['num_results'])) {
                $body['numResults'] = (int) $args['num_results'];
            }

            if (isset($args['use_autoprompt'])) {
                $body['useAutoprompt'] = (bool) $args['use_autoprompt'];
            }

            if (isset($args['type'])) {
                $body['type'] = $args['type'];
            }

            if (isset($args['category'])) {
                $body['category'] = $args['category'];
            }

            if (isset($args['start_published_date'])) {
                $body['startPublishedDate'] = $args['start_published_date'];
            }

            $result = $this->service->search($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
