<?php

namespace OpenCompany\Integrations\Telegram\Tools;

use OpenCompany\Integrations\Telegram\TelegramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing chats the bot has interacted with.
 *
 * The Telegram Bot API does not provide a direct "list chats" endpoint.
 * This tool uses getUpdates to collect unique chats from recent updates,
 * then enriches each with getChat information.
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
        return 'List chats the bot has interacted with. Since Telegram has no direct "list chats" API, this derives chats from recent updates.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of chats to return (default: 50).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Telegram integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;

            // Fetch updates to discover chats
            $result = $this->service->getUpdates(['limit' => 100]);
            $updates = $result['result'] ?? $result;

            if (!is_array($updates)) {
                return ToolResult::success([
                    'chats' => [],
                    'count' => 0,
                ]);
            }

            // Extract unique chats from updates
            $seenChatIds = [];
            $chats = [];

            foreach ($updates as $update) {
                $chat = $this->extractChatFromUpdate($update);

                if ($chat !== null) {
                    $chatId = (string) ($chat['id'] ?? '');
                    if ($chatId !== '' && !isset($seenChatIds[$chatId])) {
                        $seenChatIds[$chatId] = true;

                        // Try to enrich with getChat info
                        try {
                            $chatInfo = $this->service->getChat($chatId);
                            $enriched = $chatInfo['result'] ?? $chatInfo;
                            $chats[] = $enriched;
                        } catch (\Throwable) {
                            // Fall back to basic chat info from the update
                            $chats[] = $chat;
                        }
                    }
                }
            }

            // Apply limit
            $chats = array_slice($chats, 0, $limit);

            return ToolResult::success([
                'chats' => $chats,
                'count' => count($chats),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Extract chat information from a Telegram update object.
     *
     * @param  array<string, mixed>  $update  A Telegram Update object
     * @return array<string, mixed>|null Chat object or null if no chat found
     */
    private function extractChatFromUpdate(array $update): ?array
    {
        // Check common update types for chat info
        $messageTypes = ['message', 'edited_message', 'channel_post', 'edited_channel_post'];

        foreach ($messageTypes as $type) {
            if (isset($update[$type]['chat'])) {
                return $update[$type]['chat'];
            }
        }

        // Callback queries contain a message with a chat
        if (isset($update['callback_query']['message']['chat'])) {
            return $update['callback_query']['message']['chat'];
        }

        // My chat member updates
        if (isset($update['my_chat_member']['chat'])) {
            return $update['my_chat_member']['chat'];
        }

        // Chat member updates
        if (isset($update['chat_member']['chat'])) {
            return $update['chat_member']['chat'];
        }

        return null;
    }
}
