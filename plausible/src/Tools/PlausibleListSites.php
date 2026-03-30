<?php

namespace OpenCompany\Integrations\Plausible\Tools;

use OpenCompany\Integrations\Plausible\PlausibleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PlausibleListSites implements Tool
{
    public function __construct(
        private PlausibleService $service,
    ) {}

    public function name(): string
    {
        return 'plausible_list_sites';
    }

    public function description(): string
    {
        return 'List websites tracked in Plausible Analytics. Returns site domains you can query for analytics data.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of sites to return (default: 100).'],
            'after' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plausible integration is not configured.');
            }

            // Try the Sites API first (available on Plausible Cloud / Enterprise)
            try {
                $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
                $result = $this->service->listSites($limit, $args['after'] ?? null);
                return ToolResult::success($result);
            } catch (\RuntimeException $e) {
                // Sites API not available — fall back to configured sites
            }

            // Return sites from configuration
            $configuredSites = $this->service->getConfiguredSites();
            if (!empty($configuredSites)) {
                $sites = array_map(fn (string $domain) => ['domain' => $domain], $configuredSites);
                return ToolResult::success([
                    'sites' => $sites,
                    'source' => 'configured',
                ]);
            }

            return ToolResult::success('No sites found. The Sites API is not available on this Plausible instance, and no sites have been configured. Ask the workspace admin to add site domains in the Plausible integration settings.');
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
