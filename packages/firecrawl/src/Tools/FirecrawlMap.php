<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\Integrations\Firecrawl\FirecrawlService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Map a website to discover all linked URLs.
 *
 * Quickly retrieves a list of all URLs found on a website without
 * scraping the full content. Useful for understanding site structure
 * before running a full crawl.
 */
class FirecrawlMap implements Tool
{
    public function __construct(
        private FirecrawlService $service,
    ) {}

    public function name(): string
    {
        return 'firecrawl_map';
    }

    public function description(): string
    {
        return 'Map a website to discover all linked URLs. Returns a list of all URLs found on the site without scraping full content. Useful for understanding site structure before crawling.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'url' => ['type' => 'string', 'required' => true, 'description' => 'The root URL to map (e.g., "https://example.com").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of URLs to return. Default: based on plan.'],
            'includeSubdomains' => ['type' => 'boolean', 'description' => 'Include URLs from subdomains. Default: false.'],
            'search' => ['type' => 'string', 'description' => 'Filter URLs that match a search term (only returns URLs containing this string).'],
            'ignoreSitemap' => ['type' => 'boolean', 'description' => 'Skip sitemap.xml discovery and only use on-page links. Default: false.'],
            'includePaths' => ['type' => 'array', 'description' => 'Only include URLs matching these path patterns.'],
            'excludePaths' => ['type' => 'array', 'description' => 'Exclude URLs matching these path patterns.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            $options = [];

            if (isset($args['limit'])) {
                $options['limit'] = (int) $args['limit'];
            }
            if (isset($args['includeSubdomains'])) {
                $options['includeSubdomains'] = (bool) $args['includeSubdomains'];
            }
            if (isset($args['search'])) {
                $options['search'] = $args['search'];
            }
            if (isset($args['ignoreSitemap'])) {
                $options['ignoreSitemap'] = (bool) $args['ignoreSitemap'];
            }
            if (isset($args['includePaths'])) {
                $options['includePaths'] = $args['includePaths'];
            }
            if (isset($args['excludePaths'])) {
                $options['excludePaths'] = $args['excludePaths'];
            }

            $result = $this->service->map($args['url'], $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
