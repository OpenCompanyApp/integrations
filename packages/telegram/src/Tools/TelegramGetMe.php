<?php

namespace OpenCompany\Integrations\Telegram\Tools;

use OpenCompany\Integrations\Telegram\TelegramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for getting information about the authenticated Telegram bot.
 *
 * Returns the bot's user profile including username, name, and bot capabilities.
 * Useful for verifying the connection and identity of the bot.
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
        return 'Get information about the authenticated bot — username, display name, and capabilities.';
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

            $bot = $result['result'] ?? $result;

            return ToolResult::success($bot);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
