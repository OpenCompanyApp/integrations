<?php

namespace OpenCompany\Integrations\Tableau\Tools;

use OpenCompany\Integrations\Tableau\TableauService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TableauGetView implements Tool
{
    public function __construct(
        private TableauService $service,
    ) {}

    public function name(): string
    {
        return 'tableau_get_view';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Tableau view (dashboard or sheet), including its workbook, owner, and usage stats. Requires the view LUID.';
    }

    public function parameters(): array
    {
        return [
            'view_id' => ['type' => 'string', 'required' => true, 'description' => 'The view LUID (unique identifier). Obtain from tableau_list_views.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tableau integration is not configured. Ensure access_token and site_id are set.');
            }

            $viewId = $args['view_id'] ?? '';
            if (empty($viewId)) {
                return ToolResult::error('view_id is required.');
            }

            $result = $this->service->getView($viewId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
