<?php

namespace OpenCompany\Integrations\Netlify\Tools;

use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NetlifyListDnsZones implements Tool
{
    public function __construct(
        private NetlifyService $service,
    ) {}

    public function name(): string
    {
        return 'netlify_list_dns_zones';
    }

    public function description(): string
    {
        return 'List all DNS zones configured in Netlify. Returns zone IDs, domain names, and nameservers.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of DNS zones per page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Netlify integration is not configured.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listDnsZones($params);

            $zones = array_map(function (array $zone): array {
                return [
                    'id' => $zone['id'] ?? null,
                    'name' => $zone['name'] ?? null,
                    'domain' => $zone['domain'] ?? null,
                    'nameservers' => $zone['nameservers'] ?? [],
                    'site_id' => $zone['site_id'] ?? null,
                    'created_at' => $zone['created_at'] ?? null,
                    'updated_at' => $zone['updated_at'] ?? null,
                ];
            }, is_array($result) ? $result : []);

            return ToolResult::success([
                'dns_zones' => $zones,
                'total' => count($zones),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
