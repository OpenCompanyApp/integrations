<?php

namespace OpenCompany\Integrations\Tableau\Tools;

use OpenCompany\Integrations\Tableau\TableauService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TableauListViews implements Tool
{
    public function __construct(
        private TableauService $service,
    ) {}

    public function name(): string
    {
        return 'tableau_list_views';
    }

    public function description(): string
    {
        return 'List views (dashboards and sheets) available on the Tableau site. Returns view names, IDs, and associated workbooks. Use view IDs with tableau_get_view for full details.';
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of views per page (default: 100, max: 1000).'],
            'page_number' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based, default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tableau integration is not configured. Ensure access_token and site_id are set.');
            }

            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 100;
            $pageNumber = isset($args['page_number']) ? (int) $args['page_number'] : 1;

            $result = $this->service->listViews($pageSize, $pageNumber);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
