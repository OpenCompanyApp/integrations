<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Get the number of the resource.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /deviceAppManagement/mobileApps/{mobileApp-id}/graph.managedMobileLobApp/contentVersions/{mobileAppContent-id}/containedApps/$count.
 */
class MicrosoftIntuneDeviceAppManagementMobileAppsAsManagedMobileLobAppContentVersionsContainedAppsGetCount4c53 extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_app_management_mobile_apps_as_managed_mobile_lob_app_content_versions_contained_apps_get_count_4c53';
    protected const DESCRIPTION = 'Get the number of the resource\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /deviceAppManagement/mobileApps/{mobileApp-id}/graph.managedMobileLobApp/contentVersions/{mobileAppContent-id}/containedApps/$count.';
    protected const PARAMETERS = ['mobile_app_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `mobileApp-id`.'], 'mobile_app_content_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `mobileAppContent-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/deviceAppManagement/mobileApps/{mobileApp-id}/graph.managedMobileLobApp/contentVersions/{mobileAppContent-id}/containedApps/$count';
    protected const PATH_PARAMS = ['mobileApp-id' => 'mobile_app_id', 'mobileAppContent-id' => 'mobile_app_content_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
