<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OpenAlex\OpenAlexService;

/**
 * Check OpenAlex API key rate-limit status.
 */
class OpenAlexRateLimit implements Tool
{
    /**
     * @param  OpenAlexService  $service  OpenAlex API client.
     */
    public function __construct(private OpenAlexService $service) {}

    public function name(): string
    {
        return 'openalex_rate_limit';
    }

    public function description(): string
    {
        return 'Check the current OpenAlex API key rate-limit status and remaining allowance.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the OpenAlex rate-limit endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            return ToolResult::success($this->service->rateLimit());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
