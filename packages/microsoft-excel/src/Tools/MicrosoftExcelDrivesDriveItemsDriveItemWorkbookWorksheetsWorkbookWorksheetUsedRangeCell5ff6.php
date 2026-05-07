<?php

namespace OpenCompany\Integrations\MicrosoftExcel\Tools;

/**
 * Invoke function cell.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/usedRange()/cell(row={row},column={column}).
 */
class MicrosoftExcelDrivesDriveItemsDriveItemWorkbookWorksheetsWorkbookWorksheetUsedRangeCell5ff6 extends AbstractMicrosoftExcelTool
{
    protected const NAME = 'microsoft_excel_drives_drive_items_drive_item_workbook_worksheets_workbook_worksheet_used_range_cell_5ff6';
    protected const DESCRIPTION = 'Invoke function cell\n\nOfficial Microsoft Graph v1.0 endpoint: GET /drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/usedRange()/cell(row={row},column={column}).';
    protected const PARAMETERS = ['drive_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `drive-id`.'], 'drive_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `driveItem-id`.'], 'workbook_worksheet_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workbookWorksheet-id`.'], 'row' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `row`.'], 'column' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `column`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'workbook_session_id' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Workbook-Session-Id` header for persistent or non-persistent Excel sessions.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'GET';
    protected const PATH = '/drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/usedRange()/cell(row={row},column={column})';
    protected const PATH_PARAMS = ['drive-id' => 'drive_id', 'driveItem-id' => 'drive_item_id', 'workbookWorksheet-id' => 'workbook_worksheet_id', 'row' => 'row', 'column' => 'column'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
