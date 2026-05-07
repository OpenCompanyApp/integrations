<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\Integrations\Line\LineService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Broadcast LINE messages.
 *
 * Sends one message set to all users who added the official account as a friend.
 */
class LineBroadcastMessage implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(
        private LineService $service,
    ) {}

    public function name(): string
    {
        return 'line_broadcast_message';
    }

    public function description(): string
    {
        return 'Broadcast a message to all users who have added the LINE Official Account as a friend. Supports all message types.';
    }

    public function parameters(): array
    {
        return [
            'messages' => ['type' => 'array', 'required' => true, 'description' => 'Array of message objects to broadcast. Each message must have a "type" (e.g., "text", "image", "flex"). Example: [{"type": "text", "text": "Announcement!"}].'],
            'notification_disabled' => ['type' => 'boolean', 'description' => 'If true, recipients will not receive push notifications. Default: false.'],
        ];
    }

    /**
     * Broadcast messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
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

            $this->service->broadcastMessage(
                $args['messages'],
                (bool) $notificationDisabled,
            );

            return ToolResult::success([
                'broadcast' => true,
                'message_count' => count($args['messages']),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
