<?php

namespace OpenCompany\Integrations\PlanetScale\Tools;

use OpenCompany\Integrations\PlanetScale\PlanetScaleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PlanetScaleListOrganizations implements Tool
{
    public function __construct(
        private PlanetScaleService $service,
    ) {}

    public function name(): string
    {
        return 'planetscale_list_organizations';
    }

    public function description(): string
    {
        return 'List organizations the authenticated user belongs to. Useful for discovering organization names needed by other PlanetScale tools.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PlanetScale integration is not configured.');
            }

            $result = $this->service->listOrganizations();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
