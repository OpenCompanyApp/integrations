<?php

namespace OpenCompany\Integrations\Cloudflare\Tools;

use OpenCompany\Integrations\Cloudflare\CloudflareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CloudflareListZones implements Tool
{
    public function __construct(
        private CloudflareService $service,
    ) {}

    public function name(): string
    {
        return 'cloudflare_list_zones';
    }

    public function description(): string
    {
        return 'List all Cloudflare zones (domains). Returns zone IDs, names, status, and plan info. Use this to discover zone identifiers needed for DNS and analytics operations.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'description' => 'Filter by zone name (e.g., "example.com").'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: active, pending, initializing, moved, deleted, deactivated.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of zones per page (default: 20, max: 50).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cloudflare integration is not configured.');
            }

            $params = [];
            if (isset($args['name'])) {
                $params['name'] = $args['name'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listZones($params);

            if (($result['success'] ?? false) === false) {
                $errors = $result['errors'] ?? [];
                $msg = array_map(fn (array $e) => ($e['message'] ?? 'Unknown error'), $errors);
                return ToolResult::error('Cloudflare API error: ' . implode('; ', $msg));
            }

            $zones = $result['result'] ?? [];
            $summary = array_map(function (array $zone): array {
                return [
                    'id' => $zone['id'] ?? null,
                    'name' => $zone['name'] ?? null,
                    'status' => $zone['status'] ?? null,
                    'plan' => $zone['plan']['name'] ?? null,
                ];
            }, $zones);

            return ToolResult::success([
                'zones' => $summary,
                'total' => $result['result_info']['total_count'] ?? count($summary),
                'page' => $result['result_info']['page'] ?? 1,
                'per_page' => $result['result_info']['per_page'] ?? count($summary),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
