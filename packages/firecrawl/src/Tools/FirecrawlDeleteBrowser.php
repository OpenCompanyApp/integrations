<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * Delete a Firecrawl browser session.
 */
class FirecrawlDeleteBrowser implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_delete_browser';
    }

    public function description(): string
    {
        return 'Delete or stop a Firecrawl browser session.';
    }

    public function parameters(): array
    {
        return ['session_id' => ['type' => 'string', 'required' => true, 'description' => 'Browser session ID.']];
    }

    /**
     * Delete a browser session.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            return ToolResult::success($this->service->deleteBrowser((string) ($args['session_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
