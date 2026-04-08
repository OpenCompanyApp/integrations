<?php

namespace OpenCompany\Integrations\Perplexity\Tools;

use OpenCompany\Integrations\Perplexity\PerplexityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PerplexityGetCurrentUser implements Tool
{
    public function __construct(
        private PerplexityService $service,
    ) {}

    public function name(): string
    {
        return 'perplexity_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Perplexity API user, including account details and usage.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Perplexity integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
