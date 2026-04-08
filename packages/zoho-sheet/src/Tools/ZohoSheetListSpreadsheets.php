<?php

namespace OpenCompany\Integrations\ZohoSheet\Tools;

use OpenCompany\Integrations\ZohoSheet\ZohoSheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * ZohoSheetListSpreadsheets — List all spreadsheets accessible to the authenticated user.
 *
 * Supports pagination via page and per_page parameters. Returns a list of
 * spreadsheet resources including names, IDs, and metadata.
 */
class ZohoSheetListSpreadsheets implements Tool
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
        return 'zoho_sheet_list_spreadsheets';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List all spreadsheets accessible to the authenticated Zoho Sheet user. Returns spreadsheet names, IDs, and metadata. Use this to discover available spreadsheets before querying worksheets or rows.';
    }

    /**
     * Parameter schema for this tool.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of spreadsheets per page (default: 25, max: 100).'],
        ];
    }

    /**
     * Execute the list spreadsheets API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, per_page).
     * @return ToolResult The list of spreadsheets or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Sheet integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 25;

            $result = $this->service->listSpreadsheets($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
