<?php

namespace OpenCompany\Integrations\Patreon\Tools;

use OpenCompany\Integrations\Patreon\PatreonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PatreonListCampaigns implements Tool
{
    public function __construct(
        private PatreonService $service,
    ) {}

    public function name(): string
    {
        return 'patreon_list_campaigns';
    }

    public function description(): string
    {
        return 'List all campaigns for the authenticated Patreon creator. Returns campaign IDs, names, descriptions, and patron counts.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Patreon integration is not configured.');
            }

            $result = $this->service->listCampaigns();

            $campaigns = $result['data'] ?? [];

            return ToolResult::success([
                'campaigns' => $campaigns,
                'totalCount' => count($campaigns),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
