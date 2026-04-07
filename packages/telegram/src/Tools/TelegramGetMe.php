<?php

namespace OpenCompany\Integrations\Telegram\Tools;

use OpenCompany\Integrations\Telegram\TelegramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about the authenticated Telegram bot.
 *
 * Returns the bot User object including id, is_bot, first_name,
 * username, and can_join_groups/can_read_all_group_messages support flags.
 */
class TelegramGetMe implements Tool
{
    public function __construct(
        private TelegramService $service,
    ) {}

    public function name(): string
    {
        return 'telegram_get_me';
    }

    public function description(): string
    {
        return 'Get information about the authenticated Telegram bot. Returns the bot ID, username, display name, and capability flags.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Telegram integration is not configured.');
            }

            $result = $this->service->getMe();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
