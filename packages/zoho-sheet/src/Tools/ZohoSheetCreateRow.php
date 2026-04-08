<?php

namespace OpenCompany\Integrations\ZohoSheet\Tools;

use OpenCompany\Integrations\ZohoSheet\ZohoSheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * ZohoSheetCreateRow — Add a new row of data to a Zoho Sheet worksheet.
 *
 * Accepts a data object mapping column headers to values and appends
 * a new row to the specified worksheet.
 */
class ZohoSheetCreateRow implements Tool
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
        return 'zoho_sheet_create_row';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a new row in a Zoho Sheet worksheet. Provide column header names as keys and their values. The row will be appended to the end of the worksheet.';
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
            'data' => ['type' => 'object', 'required' => true, 'description' => 'Row data as key-value pairs. Keys must match column headers in the worksheet (e.g., {"Name": "John", "Email": "john@example.com", "Age": 30}).'],
        ];
    }

    /**
     * Execute the create row API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, worksheet_id, data).
     * @return ToolResult The created row details or an error message.
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

            if (empty($args['data']) || !is_array($args['data'])) {
                return ToolResult::error('Row data is required and must be a key-value object.');
            }

            $result = $this->service->createRow($args['id'], $args['worksheet_id'], $args['data']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
