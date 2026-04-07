<?php

namespace OpenCompany\Integrations\PlanetScale\Tools;

use OpenCompany\Integrations\PlanetScale\PlanetScaleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PlanetScaleGetCurrentUser implements Tool
{
    public function __construct(
        private PlanetScaleService $service,
    ) {}

    public function name(): string
    {
        return 'planetscale_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated PlanetScale user. Useful for verifying API credentials and retrieving account information.';
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

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
