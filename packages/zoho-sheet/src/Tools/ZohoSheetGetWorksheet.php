<?php

namespace OpenCompany\Integrations\ZohoSheet\Tools;

use OpenCompany\Integrations\ZohoSheet\ZohoSheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * ZohoSheetGetWorksheet — Get details of a specific worksheet in a Zoho Sheet spreadsheet.
 *
 * Returns full worksheet metadata including name, row/column counts,
 * header information, and other worksheet properties.
 */
class ZohoSheetGetWorksheet implements Tool
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
        return 'zoho_sheet_get_worksheet';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details of a specific worksheet within a Zoho Sheet spreadsheet. Returns worksheet metadata including name, row/column counts, and header information.';
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
        ];
    }

    /**
     * Execute the get worksheet API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, worksheet_id).
     * @return ToolResult The worksheet details or an error message.
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

            $result = $this->service->getWorksheet($args['id'], $args['worksheet_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
