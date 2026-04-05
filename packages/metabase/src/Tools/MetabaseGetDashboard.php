<?php

namespace OpenCompany\Integrations\Metabase\Tools;

use OpenCompany\Integrations\Metabase\MetabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MetabaseGetDashboard implements Tool
{
    public function __construct(
        private MetabaseService $service,
    ) {}

    public function name(): string
    {
        return 'metabase_get_dashboard';
    }

    public function description(): string
    {
        return 'Get a single Metabase dashboard by ID, including all cards (questions), layout, and parameters. Use metabase_list_dashboards to find dashboard IDs.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The dashboard ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Metabase integration is not configured.');
            }

            $dashboard = $this->service->getDashboard((int) $args['id']);

            return ToolResult::success($dashboard);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
