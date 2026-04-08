<?php

namespace OpenCompany\Integrations\Telegram\Tools;

use OpenCompany\Integrations\Telegram\TelegramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List recent chats the bot has interacted with.
 *
 * Telegram Bot API does not have a direct "list chats" endpoint.
 * This tool fetches recent updates and extracts unique chat objects
 * from them, providing a summary of recent conversations.
 */
class TelegramListChats implements Tool
{
    public function __construct(
        private TelegramService $service,
    ) {}

    public function name(): string
    {
        return 'telegram_list_chats';
    }

    public function description(): string
    {
        return 'List recent chats the bot has interacted with. Since Telegram Bot API does not have a native list-chats endpoint, this fetches recent updates and extracts unique chats. Returns chat IDs, types, and titles.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of updates to scan for chats (1–100). Default: 100.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Telegram integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;

            $updates = $this->service->listUpdates(null, $limit);

            // Extract unique chats from updates
            $chats = [];
            $seenIds = [];

            if (is_array($updates)) {
                foreach ($updates as $update) {
                    $chat = null;

                    // Extract chat from various update types
                    if (isset($update['message']['chat'])) {
                        $chat = $update['message']['chat'];
                    } elseif (isset($update['edited_message']['chat'])) {
                        $chat = $update['edited_message']['chat'];
                    } elseif (isset($update['channel_post']['chat'])) {
                        $chat = $update['channel_post']['chat'];
                    } elseif (isset($update['edited_channel_post']['chat'])) {
                        $chat = $update['edited_channel_post']['chat'];
                    } elseif (isset($update['callback_query']['message']['chat'])) {
                        $chat = $update['callback_query']['message']['chat'];
                    } elseif (isset($update['my_chat_member']['chat'])) {
                        $chat = $update['my_chat_member']['chat'];
                    }

                    if ($chat !== null && !isset($seenIds[$chat['id']])) {
                        $seenIds[$chat['id']] = true;
                        $chats[] = [
                            'id' => $chat['id'],
                            'type' => $chat['type'] ?? 'unknown',
                            'title' => $chat['title'] ?? null,
                            'username' => $chat['username'] ?? null,
                            'first_name' => $chat['first_name'] ?? null,
                            'last_name' => $chat['last_name'] ?? null,
                        ];
                    }
                }
            }

            return ToolResult::success($chats);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
