<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Invoke action renewUpload.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /deviceAppManagement/mobileApps/{mobileApp-id}/graph.macOSLobApp/contentVersions/{mobileAppContent-id}/files/{mobileAppContentFile-id}/renewUpload.
 */
class MicrosoftIntuneDeviceAppManagementMobileAppsMobileAppMicrosoftGraphMacOSLobAppContentVersionsMobileAppContentFilesMobileAppContentFileRenewUpload extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_app_management_mobile_apps_mobile_app_microsoft_graph_mac_oslob_app_content_versions_mobile_app_content_files_mobile_app_content_file_renew_upload';
    protected const DESCRIPTION = 'Invoke action renewUpload\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /deviceAppManagement/mobileApps/{mobileApp-id}/graph.macOSLobApp/contentVersions/{mobileAppContent-id}/files/{mobileAppContentFile-id}/renewUpload.';
    protected const PARAMETERS = ['mobile_app_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `mobileApp-id`.'], 'mobile_app_content_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `mobileAppContent-id`.'], 'mobile_app_content_file_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `mobileAppContentFile-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'POST';
    protected const PATH = '/deviceAppManagement/mobileApps/{mobileApp-id}/graph.macOSLobApp/contentVersions/{mobileAppContent-id}/files/{mobileAppContentFile-id}/renewUpload';
    protected const PATH_PARAMS = ['mobileApp-id' => 'mobile_app_id', 'mobileAppContent-id' => 'mobile_app_content_id', 'mobileAppContentFile-id' => 'mobile_app_content_file_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
