<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\Integrations\OneSignal\OneSignalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List push notifications sent via OneSignal.
 *
 * Supports pagination via limit and offset parameters. Returns an array
 * of notification objects including delivery statistics.
 */
class OneSignalListNotifications implements Tool
{
    public function __construct(
        private OneSignalService $service,
    ) {}

    public function name(): string
    {
        return 'onesignal_list_notifications';
    }

    public function description(): string
    {
        return 'List push notifications sent through OneSignal. Returns notification details including delivery stats, click counts, and outcomes. Use limit and offset for pagination.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'string', 'required' => true, 'description' => 'The OneSignal app ID to list notifications for.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of notifications to return (default: 50, max: 50).'],
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

            $result = $this->service->listNotifications($appId, $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
