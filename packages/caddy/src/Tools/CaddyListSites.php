<?php

namespace OpenCompany\Integrations\Caddy\Tools;

use OpenCompany\Integrations\Caddy\CaddyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CaddyListSites implements Tool
{
    public function __construct(
        private CaddyService $service,
    ) {}

    public function name(): string
    {
        return 'caddy_list_sites';
    }

    public function description(): string
    {
        return 'List all Caddy sites. Returns site IDs, domain names, status, and configuration details.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of sites per page (default: 20).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Caddy integration is not configured.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listSites($params);

            $sites = $result['sites'] ?? $result['data'] ?? [];

            $summary = array_map(function (array $site): array {
                return [
                    'id' => $site['id'] ?? null,
                    'name' => $site['name'] ?? $site['domain'] ?? null,
                    'status' => $site['status'] ?? null,
                ];
            }, is_array($sites) ? $sites : []);

            return ToolResult::success([
                'sites' => $summary,
                'total' => $result['total'] ?? count($summary),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
