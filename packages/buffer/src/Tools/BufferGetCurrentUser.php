<?php

namespace OpenCompany\Integrations\Buffer\Tools;

use OpenCompany\Integrations\Buffer\BufferService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Buffer user.
 *
 * Returns the profile of the authenticated user, including
 * name, email, and account details.
 */
class BufferGetCurrentUser implements Tool
{
    public function __construct(
        private BufferService $service,
    ) {}

    public function name(): string
    {
        return 'buffer_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Buffer user profile. Returns the user name, email, and account info.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buffer integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
