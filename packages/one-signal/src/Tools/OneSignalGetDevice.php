<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\Integrations\OneSignal\OneSignalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific device (player) by its ID.
 *
 * Returns the full player object including push token, session count,
 * amount of time spent, tags, and other metadata.
 */
class OneSignalGetDevice implements Tool
{
    public function __construct(
        private OneSignalService $service,
    ) {}

    public function name(): string
    {
        return 'onesignal_get_device';
    }

    public function description(): string
    {
        return 'Get details of a specific OneSignal device (player) by its ID. Returns push token, platform, session data, tags, and more.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The device/player ID to retrieve.'],
            'app_id' => ['type' => 'string', 'required' => true, 'description' => 'The OneSignal app ID the device belongs to.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneSignal integration is not configured.');
            }

            $result = $this->service->getDevice($args['id'], $args['app_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
