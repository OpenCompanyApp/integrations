<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Create new navigation property to logCollectionRequests for users.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /users/{user-id}/managedDevices/{managedDevice-id}/logCollectionRequests.
 */
class MicrosoftIntuneUsersManagedDevicesCreateLogCollectionRequests extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_users_managed_devices_create_log_collection_requests';
    protected const DESCRIPTION = 'Create new navigation property to logCollectionRequests for users\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /users/{user-id}/managedDevices/{managedDevice-id}/logCollectionRequests.';
    protected const PARAMETERS = ['user_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `user-id`.'], 'managed_device_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `managedDevice-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/users/{user-id}/managedDevices/{managedDevice-id}/logCollectionRequests';
    protected const PATH_PARAMS = ['user-id' => 'user_id', 'managedDevice-id' => 'managed_device_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
