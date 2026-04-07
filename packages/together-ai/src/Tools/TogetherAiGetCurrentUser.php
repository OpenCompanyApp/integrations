<?php

namespace OpenCompany\Integrations\TogetherAi\Tools;

use OpenCompany\Integrations\TogetherAi\TogetherAiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Together AI user's account information.
 *
 * Returns user info including name, email, and account details.
 */
class TogetherAiGetCurrentUser implements Tool
{
    public function __construct(
        private TogetherAiService $service,
    ) {}

    public function name(): string
    {
        return 'togetherai_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Together AI user\'s account information, including name, email, and plan details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Together AI integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
