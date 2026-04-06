<?php

namespace OpenCompany\Integrations\Telegram\Tools;

use OpenCompany\Integrations\Telegram\TelegramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for sending text messages via the Telegram Bot API.
 *
 * Sends a text message to a specified chat. Supports Markdown/HTML formatting
 * via the parse_mode parameter and inline keyboards via reply_markup.
 */
class TelegramSendMessage implements Tool
{
    public function __construct(
        private TelegramService $service,
    ) {}

    public function name(): string
    {
        return 'telegram_send_message';
    }

    public function description(): string
    {
        return 'Send a text message to a Telegram chat. Supports Markdown and HTML formatting. The chat must have an active conversation with the bot.';
    }

    public function parameters(): array
    {
        return [
            'chat_id' => ['type' => 'string', 'required' => true, 'description' => 'Unique identifier for the target chat or username (e.g., "@channelname").'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'Text of the message to send (max 4096 characters).'],
            'parse_mode' => ['type' => 'string', 'description' => 'Formatting mode: "MarkdownV2", "HTML", or "Markdown".'],
            'disable_notification' => ['type' => 'boolean', 'description' => 'Send silently without notification (default: false).'],
            'reply_to_message_id' => ['type' => 'integer', 'description' => 'ID of the message to reply to.'],
            'reply_markup' => ['type' => 'string', 'description' => 'JSON-encoded inline keyboard or reply markup.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Telegram integration is not configured.');
            }

            $chatId = $args['chat_id'];
            $text = $args['text'];

            $options = [];
            if (isset($args['parse_mode'])) {
                $options['parse_mode'] = $args['parse_mode'];
            }
            if (isset($args['disable_notification'])) {
                $options['disable_notification'] = (bool) $args['disable_notification'];
            }
            if (isset($args['reply_to_message_id'])) {
                $options['reply_to_message_id'] = (int) $args['reply_to_message_id'];
            }
            if (isset($args['reply_markup'])) {
                $markup = $args['reply_markup'];
                $options['reply_markup'] = is_string($markup) ? json_decode($markup, true) : $markup;
            }

            $result = $this->service->sendMessage($chatId, $text, $options);

            // Telegram wraps in {ok: true, result: {...}}
            $message = $result['result'] ?? $result;

            return ToolResult::success([
                'message_id' => $message['message_id'] ?? null,
                'chat' => $message['chat'] ?? [],
                'date' => $message['date'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
