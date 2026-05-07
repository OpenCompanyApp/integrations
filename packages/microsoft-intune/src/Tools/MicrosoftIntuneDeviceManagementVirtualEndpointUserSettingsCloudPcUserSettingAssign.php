<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Invoke action assign.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /deviceManagement/virtualEndpoint/userSettings/{cloudPcUserSetting-id}/assign.
 */
class MicrosoftIntuneDeviceManagementVirtualEndpointUserSettingsCloudPcUserSettingAssign extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_virtual_endpoint_user_settings_cloud_pc_user_setting_assign';
    protected const DESCRIPTION = 'Invoke action assign\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /deviceManagement/virtualEndpoint/userSettings/{cloudPcUserSetting-id}/assign.';
    protected const PARAMETERS = ['cloud_pc_user_setting_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `cloudPcUserSetting-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/deviceManagement/virtualEndpoint/userSettings/{cloudPcUserSetting-id}/assign';
    protected const PATH_PARAMS = ['cloudPcUserSetting-id' => 'cloud_pc_user_setting_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
