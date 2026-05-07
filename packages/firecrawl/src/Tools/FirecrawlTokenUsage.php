<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * Get remaining Firecrawl extract tokens.
 */
class FirecrawlTokenUsage implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_token_usage';
    }

    public function description(): string
    {
        return 'Get remaining Firecrawl extract tokens for the configured team.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get team token usage.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            return ToolResult::success($this->service->tokenUsage());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
