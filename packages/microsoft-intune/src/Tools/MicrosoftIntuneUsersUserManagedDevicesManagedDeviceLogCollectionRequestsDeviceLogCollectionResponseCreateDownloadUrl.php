<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Invoke action createDownloadUrl.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /users/{user-id}/managedDevices/{managedDevice-id}/logCollectionRequests/{deviceLogCollectionResponse-id}/createDownloadUrl.
 */
class MicrosoftIntuneUsersUserManagedDevicesManagedDeviceLogCollectionRequestsDeviceLogCollectionResponseCreateDownloadUrl extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_users_user_managed_devices_managed_device_log_collection_requests_device_log_collection_response_create_download_url';
    protected const DESCRIPTION = 'Invoke action createDownloadUrl\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /users/{user-id}/managedDevices/{managedDevice-id}/logCollectionRequests/{deviceLogCollectionResponse-id}/createDownloadUrl.';
    protected const PARAMETERS = ['user_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `user-id`.'], 'managed_device_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `managedDevice-id`.'], 'device_log_collection_response_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `deviceLogCollectionResponse-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'POST';
    protected const PATH = '/users/{user-id}/managedDevices/{managedDevice-id}/logCollectionRequests/{deviceLogCollectionResponse-id}/createDownloadUrl';
    protected const PATH_PARAMS = ['user-id' => 'user_id', 'managedDevice-id' => 'managed_device_id', 'deviceLogCollectionResponse-id' => 'device_log_collection_response_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
