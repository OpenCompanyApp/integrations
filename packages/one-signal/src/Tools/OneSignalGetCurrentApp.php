<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\Integrations\OneSignal\OneSignalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of the current OneSignal app by its ID.
 *
 * Returns the full app object including name, site URL, player count,
 * GCM/FCM key, APNS certificate status, and other configuration.
 */
class OneSignalGetCurrentApp implements Tool
{
    public function __construct(
        private OneSignalService $service,
    ) {}

    public function name(): string
    {
        return 'onesignal_get_current_app';
    }

    public function description(): string
    {
        return 'Get details of a specific OneSignal app by its ID. Returns app configuration, player counts, and platform settings.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'required' => true, 'description' => 'The OneSignal app ID to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneSignal integration is not configured.');
            }

            $result = $this->service->getCurrentApp($args['app_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
