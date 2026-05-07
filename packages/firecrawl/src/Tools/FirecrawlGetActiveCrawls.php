<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * List active Firecrawl crawl jobs for the team.
 */
class FirecrawlGetActiveCrawls implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_get_active_crawls';
    }

    public function description(): string
    {
        return 'List currently active Firecrawl crawl jobs for the configured team.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List active crawls.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            return ToolResult::success($this->service->getActiveCrawls());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
