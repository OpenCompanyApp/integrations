<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\Integrations\Pushover\PushoverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PushoverSendMessage implements Tool
{
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_send_message';
    }

    public function description(): string
    {
        return 'Send a push notification via Pushover. Supports message, title, priority levels, and optional URL/sound attachments.';
    }

    public function parameters(): array
    {
        return [
            'message' => ['type' => 'string', 'required' => true, 'description' => 'The notification message body.'],
            'title' => ['type' => 'string', 'description' => 'Optional title for the notification.'],
            'priority' => ['type' => 'integer', 'description' => 'Message priority: -2 = no notification/alert, -1 = quiet notification, 0 = normal (default), 1 = high priority (bypasses quiet hours), 2 = emergency (requires acknowledgment).'],
            'url' => ['type' => 'string', 'description' => 'A supplementary URL to include with the notification.'],
            'url_title' => ['type' => 'string', 'description' => 'Title for the supplementary URL.'],
            'sound' => ['type' => 'string', 'description' => 'Notification sound name (e.g., "pushover", "bike", "echo"). Use the list_sounds tool to see available options.'],
            'device' => ['type' => 'string', 'description' => 'Specific device name to send to. Omit to send to all devices.'],
            'timestamp' => ['type' => 'integer', 'description' => 'Unix timestamp to schedule the message delivery.'],
            'expire' => ['type' => 'integer', 'description' => 'Seconds until emergency-priority (2) messages expire (max 10800).'],
            'retry' => ['type' => 'integer', 'description' => 'Seconds between retries for emergency-priority (2) messages (min 30).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $message = $args['message'];
            $title = $args['title'] ?? null;
            $priority = $args['priority'] ?? null;

            // Validate priority
            if ($priority !== null && ($priority < -2 || $priority > 2)) {
                return ToolResult::error('Priority must be between -2 and 2.');
            }

            // Emergency priority requires expire and retry
            if ($priority === 2) {
                if (!isset($args['expire']) || !isset($args['retry'])) {
                    return ToolResult::error('Emergency priority (2) requires both "expire" and "retry" parameters.');
                }
                if ((int) $args['retry'] < 30) {
                    return ToolResult::error('Emergency "retry" must be at least 30 seconds.');
                }
                if ((int) $args['expire'] > 10800) {
                    return ToolResult::error('Emergency "expire" must not exceed 10800 seconds (3 hours).');
                }
            }

            // Build extra params
            $extra = [];
            foreach (['url', 'url_title', 'sound', 'device', 'timestamp', 'expire', 'retry'] as $key) {
                if (isset($args[$key])) {
                    $extra[$key] = $args[$key];
                }
            }

            $result = $this->service->sendMessage($message, $title, $priority, $extra);

            return ToolResult::success([
                'status' => 'sent',
                'request' => $result['request'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
