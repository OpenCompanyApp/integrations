<?php

namespace OpenCompany\Integrations\Telegram\Tools;

use OpenCompany\Integrations\Telegram\TelegramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for sending photos via the Telegram Bot API.
 *
 * Sends a photo to a specified chat. The photo can be provided as a URL
 * or as a file_id of a previously uploaded photo.
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
        return 'Send a photo to a Telegram chat. Pass a URL or a file_id of a previously uploaded photo. Optionally include a caption.';
    }

    public function parameters(): array
    {
        return [
            'chat_id' => ['type' => 'string', 'required' => true, 'description' => 'Unique identifier for the target chat or username (e.g., "@channelname").'],
            'photo' => ['type' => 'string', 'required' => true, 'description' => 'URL of the photo to send, or file_id of a previously uploaded photo.'],
            'caption' => ['type' => 'string', 'description' => 'Photo caption (0-1024 characters).'],
            'parse_mode' => ['type' => 'string', 'description' => 'Formatting mode for the caption: "MarkdownV2", "HTML", or "Markdown".'],
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
            $photo = $args['photo'];

            $options = [];
            if (isset($args['caption'])) {
                $options['caption'] = $args['caption'];
            }
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

            $result = $this->service->sendPhoto($chatId, $photo, $options);

            $message = $result['result'] ?? $result;

            return ToolResult::success([
                'message_id' => $message['message_id'] ?? null,
                'chat' => $message['chat'] ?? [],
                'date' => $message['date'] ?? null,
                'photo' => $message['photo'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
