<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Invoke action resetPasscode.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /deviceManagement/managedDevices/{managedDevice-id}/resetPasscode.
 */
class MicrosoftIntuneDeviceManagementManagedDevicesManagedDeviceResetPasscode extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_managed_devices_managed_device_reset_passcode';
    protected const DESCRIPTION = 'Invoke action resetPasscode\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /deviceManagement/managedDevices/{managedDevice-id}/resetPasscode.';
    protected const PARAMETERS = ['managed_device_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `managedDevice-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'POST';
    protected const PATH = '/deviceManagement/managedDevices/{managedDevice-id}/resetPasscode';
    protected const PATH_PARAMS = ['managedDevice-id' => 'managed_device_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
