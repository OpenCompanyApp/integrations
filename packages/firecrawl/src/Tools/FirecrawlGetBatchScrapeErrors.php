<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * Retrieve failed pages for a Firecrawl batch scrape job.
 */
class FirecrawlGetBatchScrapeErrors implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_get_batch_scrape_errors';
    }

    public function description(): string
    {
        return 'List failed URLs and errors for a Firecrawl batch scrape job.';
    }

    public function parameters(): array
    {
        return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Batch scrape job ID.']];
    }

    /**
     * Retrieve batch scrape errors by id.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            return ToolResult::success($this->service->getBatchScrapeErrors((string) ($args['id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
