<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * Get historical Firecrawl credit usage.
 */
class FirecrawlHistoricalCreditUsage implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_historical_credit_usage';
    }

    public function description(): string
    {
        return 'Get historical Firecrawl credit usage for the configured team.';
    }

    public function parameters(): array
    {
        return [
            'startDate' => ['type' => 'string', 'description' => 'Optional start date filter.'],
            'endDate' => ['type' => 'string', 'description' => 'Optional end date filter.'],
        ];
    }

    /**
     * Get historical credit usage.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            return ToolResult::success($this->service->historicalCreditUsage($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
