<?php

namespace OpenCompany\Integrations\ZohoSheet\Tools;

use OpenCompany\Integrations\ZohoSheet\ZohoSheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * ZohoSheetGetSpreadsheet — Get details of a specific Zoho Sheet spreadsheet.
 *
 * Returns full spreadsheet metadata including name, description,
 * created/modified timestamps, and worksheet references.
 */
class ZohoSheetGetSpreadsheet implements Tool
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
        return 'zoho_sheet_get_spreadsheet';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details of a specific Zoho Sheet spreadsheet by its ID. Returns spreadsheet metadata including name, description, and associated worksheets.';
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
     * Execute the get spreadsheet API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id).
     * @return ToolResult The spreadsheet details or an error message.
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

            $result = $this->service->getSpreadsheet($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
