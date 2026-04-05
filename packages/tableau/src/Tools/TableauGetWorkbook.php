<?php

namespace OpenCompany\Integrations\Tableau\Tools;

use OpenCompany\Integrations\Tableau\TableauService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TableauGetWorkbook implements Tool
{
    public function __construct(
        private TableauService $service,
    ) {}

    public function name(): string
    {
        return 'tableau_get_workbook';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Tableau workbook, including its views, connections, and permissions. Requires the workbook LUID.';
    }

    public function parameters(): array
    {
        return [
            'workbook_id' => ['type' => 'string', 'required' => true, 'description' => 'The workbook LUID (unique identifier). Obtain from tableau_list_workbooks.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tableau integration is not configured. Ensure access_token and site_id are set.');
            }

            $workbookId = $args['workbook_id'] ?? '';
            if (empty($workbookId)) {
                return ToolResult::error('workbook_id is required.');
            }

            $result = $this->service->getWorkbook($workbookId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
