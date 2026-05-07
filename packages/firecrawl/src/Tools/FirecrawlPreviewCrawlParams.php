<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * Preview crawl parameters generated from a natural-language prompt.
 */
class FirecrawlPreviewCrawlParams implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_preview_crawl_params';
    }

    public function description(): string
    {
        return 'Preview crawl parameters generated from a natural language crawl prompt.';
    }

    public function parameters(): array
    {
        return [
            'url' => ['type' => 'string', 'description' => 'Target site URL.'],
            'prompt' => ['type' => 'string', 'required' => true, 'description' => 'Natural-language crawl intent.'],
        ];
    }

    /**
     * Preview generated crawl parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            return ToolResult::success($this->service->previewCrawlParams($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
