<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\Integrations\Line\LineService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LineSendMessage implements Tool
{
    public function __construct(
        private LineService $service,
    ) {}

    public function name(): string
    {
        return 'line_send_message';
    }

    public function description(): string
    {
        return 'Send a push message to a specific LINE user, group, or room. Supports text, image, video, sticker, location, flex, and other message types.';
    }

    public function parameters(): array
    {
        return [
            'to' => ['type' => 'string', 'required' => true, 'description' => 'LINE user ID, group ID, or room ID to send the message to.'],
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of message objects. Each message must have a "type" (e.g., "text", "image", "sticker") and corresponding fields. Example for text: [{"type": "text", "text": "Hello!"}].'],
            'notification_disabled' => ['type' => 'boolean', 'description' => 'If true, the recipient will not receive a push notification. Default: false.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            if (empty($args['messages'])) {
                return ToolResult::error('At least one message is required.');
            }

            $notificationDisabled = $args['notification_disabled'] ?? false;

            $this->service->sendMessage(
                $args['to'],
                $args['messages'],
                (bool) $notificationDisabled,
            );

            return ToolResult::success([
                'to' => $args['to'],
                'message_count' => count($args['messages']),
                'sent' => true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
