<?php

namespace OpenCompany\Integrations\Tavily\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve Tavily API key and account usage details.
 *
 * Uses Tavily's GET /usage endpoint and returns key-level and account-level
 * credit usage without reshaping the upstream response.
 */
class TavilyGetUsage extends AbstractTavilyTool implements Tool
{
    public function name(): string
    {
        return 'tavily_get_usage';
    }

    public function description(): string
    {
        return 'Get Tavily API key and account usage details, including per-endpoint credit usage and plan limits.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the Tavily Usage API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments. This tool accepts no arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tavily integration is not configured.');
            }

            return ToolResult::success($this->service->usage());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
