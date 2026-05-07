<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\Integrations\Pushover\PushoverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a Pushover message to the configured user or group.
 *
 * Supports priority, URL, sound, device, emergency receipt, callback, tag, TTL, and formatting fields.
 */
class PushoverSendMessage implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
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
            'priority' => ['type' => 'integer', 'description' => 'Message priority: -2 = no notification/alert, -1 = quiet notification, 0 = normal (default), 1 = high priority, 2 = emergency.'],
            'url' => ['type' => 'string', 'description' => 'A supplementary URL to include with the notification.'],
            'url_title' => ['type' => 'string', 'description' => 'Title for the supplementary URL.'],
            'sound' => ['type' => 'string', 'description' => 'Notification sound name (e.g., "pushover", "bike", "echo"). Use the list_sounds tool to see available options.'],
            'device' => ['type' => 'string', 'description' => 'Specific device name to send to. Omit to send to all devices.'],
            'timestamp' => ['type' => 'integer', 'description' => 'Unix timestamp to schedule the message delivery.'],
            'expire' => ['type' => 'integer', 'description' => 'Seconds until emergency-priority (2) messages expire (max 10800).'],
            'retry' => ['type' => 'integer', 'description' => 'Seconds between retries for emergency-priority (2) messages (min 30).'],
            'callback' => ['type' => 'string', 'description' => 'Callback URL for emergency-priority receipt acknowledgement updates.'],
            'tags' => ['type' => 'string', 'description' => 'Comma-separated emergency message tags for later cancel-by-tag operations.'],
            'ttl' => ['type' => 'integer', 'description' => 'Seconds after which an unacknowledged message should be discarded.'],
            'html' => ['type' => 'boolean', 'description' => 'Enable HTML subset formatting in the message body.'],
            'monospace' => ['type' => 'boolean', 'description' => 'Render the message body in monospace formatting.'],
            'attachment_base64' => ['type' => 'string', 'description' => 'Base64-encoded attachment content.'],
            'attachment_type' => ['type' => 'string', 'description' => 'MIME type for attachment_base64, e.g. image/jpeg.'],
            'encrypted' => ['type' => 'boolean', 'description' => 'Marks the message as already Pushover-encrypted by the caller.'],
        ];
    }

    /**
     * Send a push notification through Pushover.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the message endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $message = $args['message'] ?? '';
            if ($message === '') {
                return ToolResult::error('message is required.');
            }

            $title = $args['title'] ?? null;
            $priority = isset($args['priority']) ? (int) $args['priority'] : null;

            if ($priority !== null && ($priority < -2 || $priority > 2)) {
                return ToolResult::error('Priority must be between -2 and 2.');
            }

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

            if (! empty($args['html']) && ! empty($args['monospace'])) {
                return ToolResult::error('Only one of "html" or "monospace" can be enabled.');
            }

            $extra = [];
            foreach (['url', 'url_title', 'sound', 'device', 'timestamp', 'expire', 'retry', 'callback', 'tags', 'ttl'] as $key) {
                if (isset($args[$key])) {
                    $extra[$key] = $args[$key];
                }
            }

            foreach (['html', 'monospace', 'encrypted'] as $key) {
                if (isset($args[$key])) {
                    $extra[$key] = (bool) $args[$key] ? 1 : 0;
                }
            }

            if (isset($args['attachment_base64'])) {
                $extra['attachment_base64'] = $args['attachment_base64'];
            }

            if (isset($args['attachment_type'])) {
                $extra['attachment_type'] = $args['attachment_type'];
            }

            $result = $this->service->sendMessage($message, $title, $priority, $extra);

            return ToolResult::success([
                'status' => 'sent',
                'request' => $result['request'] ?? null,
                'receipt' => $result['receipt'] ?? null,
                'raw' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
