<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Invoke action createDownloadUrl.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /deviceManagement/mobileAppTroubleshootingEvents/{mobileAppTroubleshootingEvent-id}/appLogCollectionRequests/{appLogCollectionRequest-id}/createDownloadUrl.
 */
class MicrosoftIntuneDeviceManagementMobileAppTroubleshootingEventsMobileAppTroubleshootingEventAppLogCollectionRequestsAppLogCollectionRequestCreateDownloadUrl extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_mobile_app_troubleshooting_events_mobile_app_troubleshooting_event_app_log_collection_requests_app_log_collection_request_create_download_url';
    protected const DESCRIPTION = 'Invoke action createDownloadUrl\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /deviceManagement/mobileAppTroubleshootingEvents/{mobileAppTroubleshootingEvent-id}/appLogCollectionRequests/{appLogCollectionRequest-id}/createDownloadUrl.';
    protected const PARAMETERS = ['mobile_app_troubleshooting_event_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `mobileAppTroubleshootingEvent-id`.'], 'app_log_collection_request_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `appLogCollectionRequest-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'POST';
    protected const PATH = '/deviceManagement/mobileAppTroubleshootingEvents/{mobileAppTroubleshootingEvent-id}/appLogCollectionRequests/{appLogCollectionRequest-id}/createDownloadUrl';
    protected const PATH_PARAMS = ['mobileAppTroubleshootingEvent-id' => 'mobile_app_troubleshooting_event_id', 'appLogCollectionRequest-id' => 'app_log_collection_request_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
