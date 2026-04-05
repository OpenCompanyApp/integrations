<?php

namespace OpenCompany\Integrations\Metabase\Tools;

use OpenCompany\Integrations\Metabase\MetabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MetabaseListDashboards implements Tool
{
    public function __construct(
        private MetabaseService $service,
    ) {}

    public function name(): string
    {
        return 'metabase_list_dashboards';
    }

    public function description(): string
    {
        return 'List all dashboards available in Metabase. Returns dashboard IDs, names, and basic metadata. Use metabase_get_dashboard to retrieve the full dashboard with cards.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Metabase integration is not configured.');
            }

            $dashboards = $this->service->listDashboards();

            return ToolResult::success([
                'dashboards' => $dashboards,
                'count' => count($dashboards),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
