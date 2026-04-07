<?php

namespace OpenCompany\Integrations\Caddy\Tools;

use OpenCompany\Integrations\Caddy\CaddyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CaddyDeleteSite implements Tool
{
    public function __construct(
        private CaddyService $service,
    ) {}

    public function name(): string
    {
        return 'caddy_delete_site';
    }

    public function description(): string
    {
        return 'Delete a site from Caddy. This action is irreversible and will remove the site and its configuration.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The site identifier to delete.'],
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

            $this->service->deleteSite($siteId);

            return ToolResult::success([
                'id' => $siteId,
                'message' => "Site {$siteId} deleted successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
