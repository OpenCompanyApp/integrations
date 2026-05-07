<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * Get Firecrawl team scrape queue metrics.
 */
class FirecrawlQueueStatus implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_queue_status';
    }

    public function description(): string
    {
        return 'Get Firecrawl scrape queue metrics for the configured team.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get queue status.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            return ToolResult::success($this->service->queueStatus());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
