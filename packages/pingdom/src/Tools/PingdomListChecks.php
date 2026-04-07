<?php

namespace OpenCompany\Integrations\Pingdom\Tools;

use OpenCompany\Integrations\Pingdom\PingdomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PingdomListChecks implements Tool
{
    public function __construct(
        private PingdomService $service,
    ) {}

    public function name(): string
    {
        return 'pingdom_list_checks';
    }

    public function description(): string
    {
        return 'List all uptime checks in Pingdom. Returns check IDs, names, hostnames, statuses, and last test times.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of checks to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: "up", "down", "paused", "unknown".'],
            'tags' => ['type' => 'string', 'description' => 'Filter by tag (comma-separated).'],
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
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['tags'])) {
                $params['tags'] = $args['tags'];
            }

            $result = $this->service->listChecks($params);

            $checks = $result['checks'] ?? [];

            return ToolResult::success([
                'checks' => array_map(function (array $check): array {
                    return [
                        'id' => $check['id'] ?? null,
                        'name' => $check['name'] ?? null,
                        'hostname' => $check['hostname'] ?? null,
                        'type' => $check['type'] ?? null,
                        'status' => $check['status'] ?? null,
                        'last_test_time' => $check['last_test_time'] ?? null,
                        'last_response_time' => $check['last_response_time'] ?? null,
                        'resolution' => $check['resolution'] ?? null,
                        'tags' => $check['tags'] ?? [],
                        'created' => $check['created'] ?? null,
                    ];
                }, $checks),
                'count' => count($checks),
                'total' => $result['counts']['total'] ?? count($checks),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
