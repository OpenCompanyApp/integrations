<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * Start a Firecrawl batch scrape job for multiple URLs.
 */
class FirecrawlBatchScrape implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_batch_scrape';
    }

    public function description(): string
    {
        return 'Scrape multiple URLs in one Firecrawl batch job and poll the status with firecrawl_get_batch_scrape_status.';
    }

    public function parameters(): array
    {
        return [
            'urls' => ['type' => 'array', 'required' => true, 'description' => 'URLs to scrape.'],
            'formats' => ['type' => 'array', 'description' => 'Output formats such as markdown, html, links, screenshot, images, or json.'],
            'onlyMainContent' => ['type' => 'boolean', 'description' => 'Extract only main content.'],
            'ignoreInvalidURLs' => ['type' => 'boolean', 'description' => 'Skip invalid URLs instead of failing the whole batch.'],
            'webhook' => ['type' => 'object', 'description' => 'Optional webhook config for batch events.'],
        ];
    }

    /**
     * Start a batch scrape job.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            $urls = $args['urls'] ?? null;
            if (! is_array($urls) || $urls === []) {
                return ToolResult::error('urls must be a non-empty array.');
            }

            $options = $args;
            unset($options['urls']);

            return ToolResult::success($this->service->batchScrape($urls, $options));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
