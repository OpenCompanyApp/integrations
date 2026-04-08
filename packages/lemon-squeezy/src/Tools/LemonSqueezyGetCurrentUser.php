<?php

namespace OpenCompany\Integrations\LemonSqueezy\Tools;

use OpenCompany\Integrations\LemonSqueezy\LemonSqueezyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LemonSqueezyGetCurrentUser implements Tool
{
    public function __construct(
        private LemonSqueezyService $service,
    ) {}

    public function name(): string
    {
        return 'lemonsqueezy_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Lemon Squeezy user profile. Useful for verifying API credentials and viewing account info.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lemon Squeezy integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
