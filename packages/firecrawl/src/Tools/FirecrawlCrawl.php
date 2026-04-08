<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\Integrations\Firecrawl\FirecrawlService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Start an asynchronous crawl job for a website.
 *
 * Crawls all linked pages starting from the given URL up to
 * configurable depth and page limits. Returns a job ID that
 * can be polled via the `firecrawl_get_crawl_status` tool.
 */
class FirecrawlCrawl implements Tool
{
    public function __construct(
        private FirecrawlService $service,
    ) {}

    public function name(): string
    {
        return 'firecrawl_crawl';
    }

    public function description(): string
    {
        return 'Start a crawl job to scrape all pages from a website starting at the given URL. Returns a crawl job ID — use firecrawl_get_crawl_status to check progress and retrieve results.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'url' => ['type' => 'string', 'required' => true, 'description' => 'The root URL to start crawling from (e.g., "https://example.com").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of pages to crawl. Default: 10.'],
            'maxDepth' => ['type' => 'integer', 'description' => 'Maximum crawl depth from the root URL. Default: based on plan.'],
            'formats' => ['type' => 'array', 'description' => 'Output formats for each page. Options: "markdown", "html", "rawHtml", "content", "links". Default: ["markdown"].'],
            'excludePaths' => ['type' => 'array', 'description' => 'URL path patterns to exclude from crawling (e.g., ["/blog/*"]).'],
            'includePaths' => ['type' => 'array', 'description' => 'Only crawl URLs matching these path patterns (e.g., ["/docs/*"]).'],
            'allowBackwardLinks' => ['type' => 'boolean', 'description' => 'Allow crawling links that go back to parent pages. Default: false.'],
            'allowExternalLinks' => ['type' => 'boolean', 'description' => 'Allow crawling links to external domains. Default: false.'],
            'onlyMainContent' => ['type' => 'boolean', 'description' => 'Extract only main content from each page. Default: true.'],
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
            if (isset($args['maxDepth'])) {
                $options['maxDepth'] = (int) $args['maxDepth'];
            }
            if (isset($args['formats'])) {
                $options['formats'] = $args['formats'];
            }
            if (isset($args['excludePaths'])) {
                $options['excludePaths'] = $args['excludePaths'];
            }
            if (isset($args['includePaths'])) {
                $options['includePaths'] = $args['includePaths'];
            }
            if (isset($args['allowBackwardLinks'])) {
                $options['allowBackwardLinks'] = (bool) $args['allowBackwardLinks'];
            }
            if (isset($args['allowExternalLinks'])) {
                $options['allowExternalLinks'] = (bool) $args['allowExternalLinks'];
            }
            if (isset($args['onlyMainContent'])) {
                $options['onlyMainContent'] = (bool) $args['onlyMainContent'];
            }

            $result = $this->service->crawl($args['url'], $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
