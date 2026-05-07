<?php

namespace OpenCompany\Integrations\MicrosoftReports\Tools;

/**
 * Invoke function managedDeviceEnrollmentFailureDetails.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /reports/managedDeviceEnrollmentFailureDetails(skip={skip},top={top},filter='{filter}',skipToken='{skipToken}').
 */
class MicrosoftReportsReportsManagedDeviceEnrollmentFailureDetailsAa46 extends AbstractMicrosoftReportsTool
{
    protected const NAME = 'microsoft_reports_reports_managed_device_enrollment_failure_details_aa46';
    protected const DESCRIPTION = 'Invoke function managedDeviceEnrollmentFailureDetails\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /reports/managedDeviceEnrollmentFailureDetails(skip={skip},top={top},filter=\'{filter}\',skipToken=\'{skipToken}\').';
    protected const PARAMETERS = ['skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'skip_token' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `skipToken`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/reports/managedDeviceEnrollmentFailureDetails(skip={skip},top={top},filter=\'{filter}\',skipToken=\'{skipToken}\')';
    protected const PATH_PARAMS = ['skip' => 'skip', 'top' => 'top', 'filter' => 'filter', 'skipToken' => 'skip_token'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
