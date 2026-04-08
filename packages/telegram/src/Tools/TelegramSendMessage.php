<?php

namespace OpenCompany\Integrations\Telegram\Tools;

use OpenCompany\Integrations\Telegram\TelegramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a text message to a Telegram chat.
 *
 * Sends a message to the specified chat and returns the sent message
 * object including message_id, date, and the message content.
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
        return 'Send a text message to a Telegram chat. Provide the chat_id and message text. The chat_id can be a numeric ID or @channelusername. Supports optional parse_mode (Markdown, MarkdownV2, HTML) and other formatting options.';
    }

    public function parameters(): array
    {
        return [
            'chat_id' => ['type' => 'string', 'required' => true, 'description' => 'Unique identifier for the target chat or @username of the target channel.'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'Text of the message to send.'],
            'parse_mode' => ['type' => 'string', 'description' => 'Parse mode for the message: Markdown, MarkdownV2, or HTML.'],
            'reply_to_message_id' => ['type' => 'integer', 'description' => 'If the message is a reply, ID of the original message.'],
            'disable_notification' => ['type' => 'boolean', 'description' => 'Send the message silently. Default: false.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Telegram integration is not configured.');
            }

            $chatId = $args['chat_id'] ?? '';
            $text = $args['text'] ?? '';

            if (empty($chatId)) {
                return ToolResult::error('chat_id is required.');
            }
            if (empty($text)) {
                return ToolResult::error('text is required.');
            }

            $options = [];
            if (isset($args['parse_mode'])) {
                $options['parse_mode'] = $args['parse_mode'];
            }
            if (isset($args['reply_to_message_id'])) {
                $options['reply_to_message_id'] = (int) $args['reply_to_message_id'];
            }
            if (isset($args['disable_notification'])) {
                $options['disable_notification'] = (bool) $args['disable_notification'];
            }

            $result = $this->service->sendMessage($chatId, $text, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
