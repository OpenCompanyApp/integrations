<?php

namespace OpenCompany\Integrations\Telegram\Tools;

use OpenCompany\Integrations\Telegram\TelegramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about a specific Telegram chat.
 *
 * Returns the Chat object including id, type, title, username,
 * first_name, last_name, and other metadata.
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
        return 'Get information about a specific Telegram chat by its ID or @username. Returns chat type, title, description, member count, and other metadata.';
    }

    public function parameters(): array
    {
        return [
            'chat_id' => ['type' => 'string', 'required' => true, 'description' => 'Unique identifier for the target chat or @username of the target channel.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Telegram integration is not configured.');
            }

            $chatId = $args['chat_id'] ?? '';
            if (empty($chatId)) {
                return ToolResult::error('chat_id is required.');
            }

            $result = $this->service->getChat($chatId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
