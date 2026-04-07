<?php

namespace OpenCompany\Integrations\Telegram\Tools;

use OpenCompany\Integrations\Telegram\TelegramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a photo to a Telegram chat.
 *
 * Sends a photo to the specified chat and returns the sent message
 * object including message_id, date, and photo file IDs.
 */
class TelegramSendPhoto implements Tool
{
    public function __construct(
        private TelegramService $service,
    ) {}

    public function name(): string
    {
        return 'telegram_send_photo';
    }

    public function description(): string
    {
        return 'Send a photo to a Telegram chat. Provide the chat_id and a photo URL or file_id. Supports optional caption with formatting and other options.';
    }

    public function parameters(): array
    {
        return [
            'chat_id' => ['type' => 'string', 'required' => true, 'description' => 'Unique identifier for the target chat or @username of the target channel.'],
            'photo' => ['type' => 'string', 'required' => true, 'description' => 'URL of the photo to send, or file_id of a photo already on Telegram servers.'],
            'caption' => ['type' => 'string', 'description' => 'Photo caption (0–1024 characters).'],
            'parse_mode' => ['type' => 'string', 'description' => 'Parse mode for the caption: Markdown, MarkdownV2, or HTML.'],
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
            $photo = $args['photo'] ?? '';

            if (empty($chatId)) {
                return ToolResult::error('chat_id is required.');
            }
            if (empty($photo)) {
                return ToolResult::error('photo is required.');
            }

            $options = [];
            if (isset($args['caption'])) {
                $options['caption'] = $args['caption'];
            }
            if (isset($args['parse_mode'])) {
                $options['parse_mode'] = $args['parse_mode'];
            }
            if (isset($args['reply_to_message_id'])) {
                $options['reply_to_message_id'] = (int) $args['reply_to_message_id'];
            }
            if (isset($args['disable_notification'])) {
                $options['disable_notification'] = (bool) $args['disable_notification'];
            }

            $result = $this->service->sendPhoto($chatId, $photo, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
