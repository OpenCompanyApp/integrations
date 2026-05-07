<?php

namespace OpenCompany\Integrations\MicrosoftExcel\Tools;

/**
 * Delete navigation property minorGridlines for drives.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/charts/{workbookChart-id}/axes/seriesAxis/minorGridlines.
 */
class MicrosoftExcelDrivesItemsWorkbookWorksheetsChartsAxesSeriesAxisDeleteMinorGridlines extends AbstractMicrosoftExcelTool
{
    protected const NAME = 'microsoft_excel_drives_items_workbook_worksheets_charts_axes_series_axis_delete_minor_gridlines';
    protected const DESCRIPTION = 'Delete navigation property minorGridlines for drives\n\nOfficial Microsoft Graph v1.0 endpoint: DELETE /drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/charts/{workbookChart-id}/axes/seriesAxis/minorGridlines.';
    protected const PARAMETERS = ['drive_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `drive-id`.'], 'drive_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `driveItem-id`.'], 'workbook_worksheet_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workbookWorksheet-id`.'], 'workbook_chart_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `workbookChart-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'workbook_session_id' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Workbook-Session-Id` header for persistent or non-persistent Excel sessions.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/drives/{drive-id}/items/{driveItem-id}/workbook/worksheets/{workbookWorksheet-id}/charts/{workbookChart-id}/axes/seriesAxis/minorGridlines';
    protected const PATH_PARAMS = ['drive-id' => 'drive_id', 'driveItem-id' => 'drive_item_id', 'workbookWorksheet-id' => 'workbook_worksheet_id', 'workbookChart-id' => 'workbook_chart_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
