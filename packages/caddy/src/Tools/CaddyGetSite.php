<?php

namespace OpenCompany\Integrations\Caddy\Tools;

use OpenCompany\Integrations\Caddy\CaddyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CaddyGetSite implements Tool
{
    public function __construct(
        private CaddyService $service,
    ) {}

    public function name(): string
    {
        return 'caddy_get_site';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Caddy site, including its configuration, domain, and status.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The site identifier.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Caddy integration is not configured.');
            }

            $siteId = $args['site_id'] ?? '';
            if (empty($siteId)) {
                return ToolResult::error('site_id is required.');
            }

            $result = $this->service->getSite($siteId);

            $site = $result['site'] ?? $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $site['id'] ?? null,
                'name' => $site['name'] ?? $site['domain'] ?? null,
                'status' => $site['status'] ?? null,
                'created_at' => $site['created_at'] ?? null,
                'updated_at' => $site['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
