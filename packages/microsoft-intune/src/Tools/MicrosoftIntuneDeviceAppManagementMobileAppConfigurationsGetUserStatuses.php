<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Get userStatuses from deviceAppManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /deviceAppManagement/mobileAppConfigurations/{managedDeviceMobileAppConfiguration-id}/userStatuses/{managedDeviceMobileAppConfigurationUserStatus-id}.
 */
class MicrosoftIntuneDeviceAppManagementMobileAppConfigurationsGetUserStatuses extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_app_management_mobile_app_configurations_get_user_statuses';
    protected const DESCRIPTION = 'Get userStatuses from deviceAppManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /deviceAppManagement/mobileAppConfigurations/{managedDeviceMobileAppConfiguration-id}/userStatuses/{managedDeviceMobileAppConfigurationUserStatus-id}.';
    protected const PARAMETERS = ['managed_device_mobile_app_configuration_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `managedDeviceMobileAppConfiguration-id`.'], 'managed_device_mobile_app_configuration_user_status_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `managedDeviceMobileAppConfigurationUserStatus-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/deviceAppManagement/mobileAppConfigurations/{managedDeviceMobileAppConfiguration-id}/userStatuses/{managedDeviceMobileAppConfigurationUserStatus-id}';
    protected const PATH_PARAMS = ['managedDeviceMobileAppConfiguration-id' => 'managed_device_mobile_app_configuration_id', 'managedDeviceMobileAppConfigurationUserStatus-id' => 'managed_device_mobile_app_configuration_user_status_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
