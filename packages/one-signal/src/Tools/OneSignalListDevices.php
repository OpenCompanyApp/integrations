<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\Integrations\OneSignal\OneSignalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List devices (players) registered in a OneSignal app.
 *
 * Supports pagination via limit and offset. Returns device tokens,
 * session counts, tags, and other player metadata.
 */
class OneSignalListDevices implements Tool
{
    /**
     * @param  OneSignalService  $service  OneSignal API client.
     */
    public function __construct(
        private OneSignalService $service,
    ) {}

    public function name(): string
    {
        return 'onesignal_list_devices';
    }

    public function description(): string
    {
        return 'List devices (players) registered in a OneSignal app. Returns device identifiers, platform, session counts, and tags. Use limit and offset for pagination.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'required' => true, 'description' => 'The OneSignal app ID to list devices for.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of devices to return (default: 50, max: 300).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneSignal integration is not configured.');
            }

            $appId = $args['app_id'];
            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listDevices($appId, $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
