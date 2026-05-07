<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Get the items of type microsoft.graph.windowsMobileMSI in the microsoft.graph.mobileApp collection.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /deviceAppManagement/mobileApps/graph.windowsMobileMSI.
 */
class MicrosoftIntuneDeviceAppManagementListMobileAppsAsWindowsMobileMSI extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_app_management_list_mobile_apps_as_windows_mobile_msi';
    protected const DESCRIPTION = 'Get the items of type microsoft.graph.windowsMobileMSI in the microsoft.graph.mobileApp collection\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /deviceAppManagement/mobileApps/graph.windowsMobileMSI.';
    protected const PARAMETERS = ['top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/deviceAppManagement/mobileApps/graph.windowsMobileMSI';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
