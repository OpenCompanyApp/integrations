<?php

namespace OpenCompany\Integrations\MicrosoftExcel\Tools;

/**
 * Invoke action setData.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/charts/item(name='{name}')/setData.
 */
class MicrosoftExcelDrivesDriveItemsDriveItemWorkbookWorksheetsWorkbookWorksheetChartsItemSetData extends AbstractMicrosoftExcelTool
{
    protected const NAME = 'microsoft_excel_drives_drive_items_drive_item_workbook_worksheets_workbook_worksheet_charts_item_set_data';
    protected const DESCRIPTION = 'Invoke action setData\n\nOfficial Microsoft Graph v1.0 endpoint: POST /drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/charts/item(name=\'{name}\')/setData.';
    protected const PARAMETERS = ['drive_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `drive-id`.'], 'drive_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `driveItem-id`.'], 'workbook_worksheet_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workbookWorksheet-id`.'], 'name' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `name`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'workbook_session_id' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Workbook-Session-Id` header for persistent or non-persistent Excel sessions.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Excel workbook OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/charts/item(name=\'{name}\')/setData';
    protected const PATH_PARAMS = ['drive-id' => 'drive_id', 'driveItem-id' => 'drive_item_id', 'workbookWorksheet-id' => 'workbook_worksheet_id', 'name' => 'name'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
