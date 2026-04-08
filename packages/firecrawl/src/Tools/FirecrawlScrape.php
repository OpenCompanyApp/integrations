<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\Integrations\Firecrawl\FirecrawlService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Scrape a single URL and return its content.
 *
 * Supports multiple output formats (markdown, HTML, raw text) and
 * optional actions like screenshots or waiting for JavaScript rendering.
 */
class FirecrawlScrape implements Tool
{
    public function __construct(
        private FirecrawlService $service,
    ) {}

    public function name(): string
    {
        return 'firecrawl_scrape';
    }

    public function description(): string
    {
        return 'Scrape a single URL and extract its content. Returns the page content in the requested format (markdown by default). Supports actions like waiting for JavaScript, taking screenshots, and extracting specific elements.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'url' => ['type' => 'string', 'required' => true, 'description' => 'The URL to scrape (e.g., "https://example.com").'],
            'formats' => ['type' => 'array', 'description' => 'Output formats to return. Options: "markdown", "html", "rawHtml", "content", "links", "screenshot", "actions". Default: ["markdown"].'],
            'onlyMainContent' => ['type' => 'boolean', 'description' => 'Extract only the main content, removing navigation, footers, etc. Default: true.'],
            'includeTags' => ['type' => 'array', 'description' => 'CSS selectors to include. Only these elements will be scraped.'],
            'excludeTags' => ['type' => 'array', 'description' => 'CSS selectors to exclude. These elements will be removed from the result.'],
            'waitFor' => ['type' => 'integer', 'description' => 'Time in milliseconds to wait for dynamic content to load before scraping.'],
            'timeout' => ['type' => 'integer', 'description' => 'Timeout in milliseconds for the scrape request. Default: 30000.'],
            'actions' => ['type' => 'array', 'description' => 'List of actions to perform before scraping (e.g., click, scroll, wait, screenshot).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            $options = [];

            if (isset($args['formats'])) {
                $options['formats'] = $args['formats'];
            }
            if (isset($args['onlyMainContent'])) {
                $options['onlyMainContent'] = (bool) $args['onlyMainContent'];
            }
            if (isset($args['includeTags'])) {
                $options['includeTags'] = $args['includeTags'];
            }
            if (isset($args['excludeTags'])) {
                $options['excludeTags'] = $args['excludeTags'];
            }
            if (isset($args['waitFor'])) {
                $options['waitFor'] = (int) $args['waitFor'];
            }
            if (isset($args['timeout'])) {
                $options['timeout'] = (int) $args['timeout'];
            }
            if (isset($args['actions'])) {
                $options['actions'] = $args['actions'];
            }

            $result = $this->service->scrape($args['url'], $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
