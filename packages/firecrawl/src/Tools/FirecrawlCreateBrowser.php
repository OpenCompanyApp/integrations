<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * Create an interactive Firecrawl browser session.
 */
class FirecrawlCreateBrowser implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_create_browser';
    }

    public function description(): string
    {
        return 'Create a Firecrawl browser session for interactive web tasks.';
    }

    public function parameters(): array
    {
        return [
            'url' => ['type' => 'string', 'description' => 'Optional URL to open when the session starts.'],
            'timeout' => ['type' => 'integer', 'description' => 'Optional session timeout in milliseconds.'],
        ];
    }

    /**
     * Create a browser session.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            return ToolResult::success($this->service->createBrowser($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
