<?php

namespace OpenCompany\Integrations\Telegram\Tools;

use OpenCompany\Integrations\Telegram\TelegramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for getting information about a specific Telegram chat.
 *
 * Returns chat details including type (private, group, supergroup, channel),
 * title, description, member count, and other metadata.
 */
class TelegramGetChat implements Tool
{
    public function __construct(
        private TelegramService $service,
    ) {}

    public function name(): string
    {
        return 'telegram_get_chat';
    }

    public function description(): string
    {
        return 'Get information about a Telegram chat — type, title, description, member count, and more.';
    }

    public function parameters(): array
    {
        return [
            'chat_id' => ['type' => 'string', 'required' => true, 'description' => 'Unique identifier for the target chat or username (e.g., "@channelname").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Telegram integration is not configured.');
            }

            $result = $this->service->getChat($args['chat_id']);

            $chat = $result['result'] ?? $result;

            return ToolResult::success($chat);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
