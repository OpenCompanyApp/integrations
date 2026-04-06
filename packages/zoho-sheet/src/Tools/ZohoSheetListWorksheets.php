<?php

namespace OpenCompany\Integrations\ZohoSheet\Tools;

use OpenCompany\Integrations\ZohoSheet\ZohoSheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * ZohoSheetListWorksheets — List all worksheets within a Zoho Sheet spreadsheet.
 *
 * Returns a list of worksheet resources with names, IDs, row/column counts,
 * and other metadata for each worksheet in the specified spreadsheet.
 */
class ZohoSheetListWorksheets implements Tool
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
        return 'zoho_sheet_list_worksheets';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all worksheets within a Zoho Sheet spreadsheet. Returns worksheet names, IDs, and metadata like row/column counts. Use this to discover worksheets before reading or writing row data.';
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
        ];
    }

    /**
     * Execute the list worksheets API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id).
     * @return ToolResult The list of worksheets or an error message.
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

            $result = $this->service->listWorksheets($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
