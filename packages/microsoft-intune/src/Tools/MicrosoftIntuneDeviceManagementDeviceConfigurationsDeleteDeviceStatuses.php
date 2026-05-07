<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Delete navigation property deviceStatuses for deviceManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /deviceManagement/deviceConfigurations/{deviceConfiguration-id}/deviceStatuses/{deviceConfigurationDeviceStatus-id}.
 */
class MicrosoftIntuneDeviceManagementDeviceConfigurationsDeleteDeviceStatuses extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_device_configurations_delete_device_statuses';
    protected const DESCRIPTION = 'Delete navigation property deviceStatuses for deviceManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /deviceManagement/deviceConfigurations/{deviceConfiguration-id}/deviceStatuses/{deviceConfigurationDeviceStatus-id}.';
    protected const PARAMETERS = ['device_configuration_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `deviceConfiguration-id`.'], 'device_configuration_device_status_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `deviceConfigurationDeviceStatus-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/deviceManagement/deviceConfigurations/{deviceConfiguration-id}/deviceStatuses/{deviceConfigurationDeviceStatus-id}';
    protected const PATH_PARAMS = ['deviceConfiguration-id' => 'device_configuration_id', 'deviceConfigurationDeviceStatus-id' => 'device_configuration_device_status_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
