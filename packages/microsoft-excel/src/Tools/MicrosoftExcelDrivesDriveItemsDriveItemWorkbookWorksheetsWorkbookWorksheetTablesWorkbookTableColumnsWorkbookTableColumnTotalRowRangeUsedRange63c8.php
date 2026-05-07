<?php

namespace OpenCompany\Integrations\MicrosoftExcel\Tools;

/**
 * Invoke function usedRange.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/tables/{workbookTable-id}/columns/{workbookTableColumn-id}/totalRowRange()/usedRange(valuesOnly={valuesOnly}).
 */
class MicrosoftExcelDrivesDriveItemsDriveItemWorkbookWorksheetsWorkbookWorksheetTablesWorkbookTableColumnsWorkbookTableColumnTotalRowRangeUsedRange63c8 extends AbstractMicrosoftExcelTool
{
    protected const NAME = 'microsoft_excel_drives_drive_items_drive_item_workbook_worksheets_workbook_worksheet_tables_workbook_table_columns_workbook_table_column_total_row_range_used_range_63c8';
    protected const DESCRIPTION = 'Invoke function usedRange\n\nOfficial Microsoft Graph v1.0 endpoint: GET /drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/tables/{workbookTable-id}/columns/{workbookTableColumn-id}/totalRowRange()/usedRange(valuesOnly={valuesOnly}).';
    protected const PARAMETERS = ['drive_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `drive-id`.'], 'drive_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `driveItem-id`.'], 'workbook_worksheet_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workbookWorksheet-id`.'], 'workbook_table_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workbookTable-id`.'], 'workbook_table_column_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workbookTableColumn-id`.'], 'values_only' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `valuesOnly`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'workbook_session_id' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Workbook-Session-Id` header for persistent or non-persistent Excel sessions.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'GET';
    protected const PATH = '/drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/tables/{workbookTable-id}/columns/{workbookTableColumn-id}/totalRowRange()/usedRange(valuesOnly={valuesOnly})';
    protected const PATH_PARAMS = ['drive-id' => 'drive_id', 'driveItem-id' => 'drive_item_id', 'workbookWorksheet-id' => 'workbook_worksheet_id', 'workbookTable-id' => 'workbook_table_id', 'workbookTableColumn-id' => 'workbook_table_column_id', 'valuesOnly' => 'values_only'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
