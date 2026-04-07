<?php

namespace OpenCompany\Integrations\Pingdom\Tools;

use OpenCompany\Integrations\Pingdom\PingdomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PingdomListAlerts implements Tool
{
    public function __construct(
        private PingdomService $service,
    ) {}

    public function name(): string
    {
        return 'pingdom_list_alerts';
    }

    public function description(): string
    {
        return 'List alerts for the Pingdom account. Returns alert details including check ID, contact, and alert type.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of alerts to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'check_id' => ['type' => 'integer', 'description' => 'Filter alerts by check ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by alert status: "sent", "not_sent", "scheduled".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pingdom integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['check_id'])) {
                $params['checkid'] = (int) $args['check_id'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }

            $result = $this->service->listAlerts($params);

            $alerts = $result['alerts'] ?? [];

            return ToolResult::success([
                'alerts' => $alerts,
                'count' => count($alerts),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
