<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * Search the web with Firecrawl and optionally scrape result pages.
 */
class FirecrawlSearch implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_search';
    }

    public function description(): string
    {
        return 'Search the web with Firecrawl and optionally scrape result pages using scrapeOptions.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum results per source, 1 to 100.'],
            'sources' => ['type' => 'array', 'description' => 'Sources to search, such as web, images, or news.'],
            'categories' => ['type' => 'array', 'description' => 'Category filters, such as github, research, or pdf.'],
            'includeDomains' => ['type' => 'array', 'description' => 'Restrict results to these domains.'],
            'excludeDomains' => ['type' => 'array', 'description' => 'Exclude results from these domains.'],
            'tbs' => ['type' => 'string', 'description' => 'Time-based search filter such as qdr:w or custom date range.'],
            'location' => ['type' => 'string', 'description' => 'Geo-targeted search location.'],
            'country' => ['type' => 'string', 'description' => 'ISO country code for search results.'],
            'scrapeOptions' => ['type' => 'object', 'description' => 'Optional Firecrawl scrape options for each result.'],
        ];
    }

    /**
     * Execute a Firecrawl search request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            if (empty($args['query'])) {
                return ToolResult::error('query is required.');
            }

            return ToolResult::success($this->service->search($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
