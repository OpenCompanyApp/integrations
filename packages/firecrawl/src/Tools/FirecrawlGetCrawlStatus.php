<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\Integrations\Firecrawl\FirecrawlService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Check the status and retrieve results of a crawl job.
 *
 * Poll this endpoint after starting a crawl with `firecrawl_crawl`.
 * Once the status is "completed", the response will include all
 * scraped page data.
 */
class FirecrawlGetCrawlStatus implements Tool
{
    public function __construct(
        private FirecrawlService $service,
    ) {}

    public function name(): string
    {
        return 'firecrawl_get_crawl_status';
    }

    public function description(): string
    {
        return 'Check the status and retrieve results of a crawl job. Returns the current status (scraping, completed, failed, cancelled) and all scraped data once complete.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The crawl job ID returned by the firecrawl_crawl tool.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            $result = $this->service->getCrawlStatus($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
