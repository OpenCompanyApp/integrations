<?php

namespace OpenCompany\Integrations\Perplexity\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Perplexity\PerplexityService;

/**
 * List asynchronous Perplexity Sonar chat requests.
 */
class PerplexityListAsyncSonar implements Tool
{
    /**
     * @param  PerplexityService  $service  The Perplexity API client.
     */
    public function __construct(
        private PerplexityService $service,
    ) {}

    public function name(): string
    {
        return 'perplexity_list_async_sonar';
    }

    public function description(): string
    {
        return 'List asynchronous Sonar chat completion requests for the configured Perplexity account.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List asynchronous Sonar requests.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Perplexity integration is not configured.');
            }

            return ToolResult::success($this->service->listAsyncSonar());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
