<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

use OpenCompany\Integrations\ManyChat\ManyChatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated ManyChat user's profile information.
 *
 * Returns account details such as the user name, email,
 * plan type, and connected channels.
 */
class ManyChatGetCurrentUser implements Tool
{
    /**
     * @param  ManyChatService  $service  The Manychat API client.
     */
    public function __construct(
        private ManyChatService $service,
    ) {}

    public function name(): string
    {
        return 'manychat_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated ManyChat user profile. Returns account details, plan info, and connected channels.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch page/account information for the authenticated bot.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ManyChat integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
