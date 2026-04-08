<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\Integrations\Firecrawl\FirecrawlService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated user's account information.
 *
 * Useful for verifying that the API key is valid and checking
 * plan limits, usage stats, and account details.
 */
class FirecrawlGetCurrentUser implements Tool
{
    public function __construct(
        private FirecrawlService $service,
    ) {}

    public function name(): string
    {
        return 'firecrawl_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s account information, including plan details and usage statistics. Useful for verifying API key validity and checking remaining credits.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
