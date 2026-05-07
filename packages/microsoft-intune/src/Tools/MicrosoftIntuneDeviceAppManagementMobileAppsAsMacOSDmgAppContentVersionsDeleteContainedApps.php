<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Delete navigation property containedApps for deviceAppManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /deviceAppManagement/mobileApps/{mobileApp-id}/graph.macOSDmgApp/contentVersions/{mobileAppContent-id}/containedApps/{mobileContainedApp-id}.
 */
class MicrosoftIntuneDeviceAppManagementMobileAppsAsMacOSDmgAppContentVersionsDeleteContainedApps extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_app_management_mobile_apps_as_mac_osdmg_app_content_versions_delete_contained_apps';
    protected const DESCRIPTION = 'Delete navigation property containedApps for deviceAppManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /deviceAppManagement/mobileApps/{mobileApp-id}/graph.macOSDmgApp/contentVersions/{mobileAppContent-id}/containedApps/{mobileContainedApp-id}.';
    protected const PARAMETERS = ['mobile_app_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `mobileApp-id`.'], 'mobile_app_content_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `mobileAppContent-id`.'], 'mobile_contained_app_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `mobileContainedApp-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/deviceAppManagement/mobileApps/{mobileApp-id}/graph.macOSDmgApp/contentVersions/{mobileAppContent-id}/containedApps/{mobileContainedApp-id}';
    protected const PATH_PARAMS = ['mobileApp-id' => 'mobile_app_id', 'mobileAppContent-id' => 'mobile_app_content_id', 'mobileContainedApp-id' => 'mobile_contained_app_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
