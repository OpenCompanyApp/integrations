<?php

namespace OpenCompany\Integrations\MicrosoftReports\Tools;

/**
 * Delete navigation property monthlyPrintUsageByPrinter for reports.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /reports/monthlyPrintUsageByPrinter/{printUsageByPrinter-id}.
 */
class MicrosoftReportsReportsDeleteMonthlyPrintUsageByPrinter extends AbstractMicrosoftReportsTool
{
    protected const NAME = 'microsoft_reports_reports_delete_monthly_print_usage_by_printer';
    protected const DESCRIPTION = 'Delete navigation property monthlyPrintUsageByPrinter for reports\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /reports/monthlyPrintUsageByPrinter/{printUsageByPrinter-id}.';
    protected const PARAMETERS = ['print_usage_by_printer_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `printUsageByPrinter-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/reports/monthlyPrintUsageByPrinter/{printUsageByPrinter-id}';
    protected const PATH_PARAMS = ['printUsageByPrinter-id' => 'print_usage_by_printer_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
