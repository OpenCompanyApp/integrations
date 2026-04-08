<?php

namespace OpenCompany\Integrations\ZohoSheet\Tools;

use OpenCompany\Integrations\ZohoSheet\ZohoSheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * ZohoSheetListRows — List rows in a Zoho Sheet worksheet with pagination.
 *
 * Returns row data from the specified worksheet. Supports pagination via
 * page and per_page parameters to handle large datasets efficiently.
 */
class ZohoSheetListRows implements Tool
{
    /**
     * @param  ZohoSheetService  $service  The Zoho Sheet API service instance.
     */
    public function __construct(
        private ZohoSheetService $service,
    ) {}

    /**
     * The tool identifier used by the integration framework.
     */
    public function name(): string
    {
        return 'zoho_sheet_list_rows';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List rows in a Zoho Sheet worksheet with pagination. Returns row data as key-value pairs using column headers as keys. Use this to read data from a specific worksheet.';
    }

    /**
     * Parameter schema for this tool.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The spreadsheet resource ID.'],
            'worksheet_id' => ['type' => 'string', 'required' => true, 'description' => 'The worksheet resource ID.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of rows per page (default: 25, max: 100).'],
        ];
    }

    /**
     * Execute the list rows API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, worksheet_id, page, per_page).
     * @return ToolResult The row data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Sheet integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Spreadsheet ID is required.');
            }

            if (empty($args['worksheet_id'])) {
                return ToolResult::error('Worksheet ID is required.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 25;

            $result = $this->service->listRows($args['id'], $args['worksheet_id'], $page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
