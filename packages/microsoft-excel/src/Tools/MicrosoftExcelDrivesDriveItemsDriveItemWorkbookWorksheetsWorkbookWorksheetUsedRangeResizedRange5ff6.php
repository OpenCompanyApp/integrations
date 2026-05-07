<?php

namespace OpenCompany\Integrations\MicrosoftExcel\Tools;

/**
 * Invoke function resizedRange.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/usedRange()/resizedRange(deltaRows={deltaRows},deltaColumns={deltaColumns}).
 */
class MicrosoftExcelDrivesDriveItemsDriveItemWorkbookWorksheetsWorkbookWorksheetUsedRangeResizedRange5ff6 extends AbstractMicrosoftExcelTool
{
    protected const NAME = 'microsoft_excel_drives_drive_items_drive_item_workbook_worksheets_workbook_worksheet_used_range_resized_range_5ff6';
    protected const DESCRIPTION = 'Invoke function resizedRange\n\nOfficial Microsoft Graph v1.0 endpoint: GET /drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/usedRange()/resizedRange(deltaRows={deltaRows},deltaColumns={deltaColumns}).';
    protected const PARAMETERS = ['drive_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `drive-id`.'], 'drive_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `driveItem-id`.'], 'workbook_worksheet_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workbookWorksheet-id`.'], 'delta_rows' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `deltaRows`.'], 'delta_columns' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `deltaColumns`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'workbook_session_id' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Workbook-Session-Id` header for persistent or non-persistent Excel sessions.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'GET';
    protected const PATH = '/drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/usedRange()/resizedRange(deltaRows={deltaRows},deltaColumns={deltaColumns})';
    protected const PATH_PARAMS = ['drive-id' => 'drive_id', 'driveItem-id' => 'drive_item_id', 'workbookWorksheet-id' => 'workbook_worksheet_id', 'deltaRows' => 'delta_rows', 'deltaColumns' => 'delta_columns'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
