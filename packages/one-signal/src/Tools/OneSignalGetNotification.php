<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\Integrations\OneSignal\OneSignalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific push notification by ID.
 *
 * Returns the full notification object including content, headings,
 * delivery statistics, click counts, and configured segments.
 */
class OneSignalGetNotification implements Tool
{
    public function __construct(
        private OneSignalService $service,
    ) {}

    public function name(): string
    {
        return 'onesignal_get_notification';
    }

    public function description(): string
    {
        return 'Get details of a specific OneSignal push notification by its ID. Returns full notification data including content, delivery stats, and targeting.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The notification ID to retrieve.'],
            'app_id' => ['type' => 'string', 'required' => true, 'description' => 'The OneSignal app ID the notification belongs to.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneSignal integration is not configured.');
            }

            $result = $this->service->getNotification($args['id'], $args['app_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
