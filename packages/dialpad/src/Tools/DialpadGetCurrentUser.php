<?php

namespace OpenCompany\Integrations\Dialpad\Tools;

use OpenCompany\Integrations\Dialpad\DialpadService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Dialpad user.
 */
class DialpadGetCurrentUser implements Tool
{
    public function __construct(
        private DialpadService $service,
    ) {}

    public function name(): string
    {
        return 'dialpad_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Dialpad user. Useful for verifying the connection and identifying which account the integration is using.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Dialpad integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
