<?php

namespace OpenCompany\Integrations\Hunter\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Hunter\HunterService;

/**
 * Get the authenticated user's account information and API usage from Hunter.io.
 */
class HunterGetCurrentUser implements Tool
{
    /** @param HunterService $service The Hunter.io API client */
    public function __construct(
        private HunterService $service,
    ) {}

    public function name(): string
    {
        return 'hunter_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get information about the authenticated Hunter.io account, including the user's
        name, email, plan details, and API usage (requests made and remaining).
        Useful for verifying the API key works and checking usage limits.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Hunter integration is not configured.');
            }

            $result = $this->service->getAccount();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
