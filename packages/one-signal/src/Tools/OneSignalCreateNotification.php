<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\Integrations\OneSignal\OneSignalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create and send a new push notification via OneSignal.
 *
 * Supports localized content and headings, segment-based targeting,
 * click-through URLs, and custom data payloads.
 */
class OneSignalCreateNotification implements Tool
{
    /**
     * @param  OneSignalService  $service  OneSignal API client.
     */
    public function __construct(
        private OneSignalService $service,
    ) {}

    public function name(): string
    {
        return 'onesignal_create_notification';
    }

    public function description(): string
    {
        return 'Send a new push notification via OneSignal. Specify message contents (per language), optional headings, target segments, a click URL, and a custom data payload.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'required' => true, 'description' => 'The OneSignal app ID to send the notification from.'],
            'payload' => ['type' => 'object', 'description' => 'Full message payload. If provided, it is sent directly with app_id.'],
            'contents' => ['type' => 'object', 'required' => true, 'description' => 'Notification body per language, e.g. {"en": "Hello!", "es": "Hola!"}. The "en" key is required.'],
            'headings' => ['type' => 'object', 'description' => 'Notification title per language, e.g. {"en": "Update"}. Defaults to the app name if omitted.'],
            'included_segments' => ['type' => 'array', 'description' => 'Segments to target, e.g. ["All", "Active Users"]. Defaults to ["All"] if omitted.'],
            'url' => ['type' => 'string', 'description' => 'URL to open when the notification is tapped.'],
            'data' => ['type' => 'object', 'description' => 'Custom key-value data payload delivered to the app when the notification is opened.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneSignal integration is not configured.');
            }

            $appId = $args['app_id'];

            if (isset($args['payload']) && is_array($args['payload'])) {
                return ToolResult::success($this->service->createMessage($appId, $args['payload']));
            }

            $contents = $args['contents'];

            if (!is_array($contents) || empty($contents)) {
                return ToolResult::error('contents must be a non-empty object with at least a language key (e.g. {"en": "Hello!"}).');
            }

            $result = $this->service->createNotification(
                appId: $appId,
                contents: $contents,
                headings: $args['headings'] ?? null,
                includedSegments: $args['included_segments'] ?? null,
                url: $args['url'] ?? null,
                data: $args['data'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
