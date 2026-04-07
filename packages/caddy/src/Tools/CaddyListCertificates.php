<?php

namespace OpenCompany\Integrations\Caddy\Tools;

use OpenCompany\Integrations\Caddy\CaddyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CaddyListCertificates implements Tool
{
    public function __construct(
        private CaddyService $service,
    ) {}

    public function name(): string
    {
        return 'caddy_list_certificates';
    }

    public function description(): string
    {
        return 'List all TLS certificates managed by Caddy. Returns certificate IDs, domains, expiry dates, and status.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of certificates per page (default: 20).'],
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

            $result = $this->service->listCertificates($params);

            $certificates = $result['certificates'] ?? $result['data'] ?? [];

            $summary = array_map(function (array $cert): array {
                return [
                    'id' => $cert['id'] ?? null,
                    'domain' => $cert['domain'] ?? $cert['sans'][0] ?? null,
                    'expires_at' => $cert['expires_at'] ?? $cert['not_after'] ?? null,
                    'status' => $cert['status'] ?? null,
                ];
            }, is_array($certificates) ? $certificates : []);

            return ToolResult::success([
                'certificates' => $summary,
                'total' => $result['total'] ?? count($summary),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
