<?php

namespace OpenCompany\Integrations\Perplexity\Tools;

use OpenCompany\Integrations\Perplexity\PerplexityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List models available to the Perplexity Agent API.
 */
class PerplexityListModels implements Tool
{
    /**
     * @param  PerplexityService  $service  The Perplexity API client.
     */
    public function __construct(
        private PerplexityService $service,
    ) {}

    public function name(): string
    {
        return 'perplexity_list_models';
    }

    public function description(): string
    {
        return 'List Perplexity Agent API models. Returns model IDs in OpenAI-compatible list format.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List Agent API models.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Perplexity integration is not configured.');
            }

            $result = $this->service->listModels();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
