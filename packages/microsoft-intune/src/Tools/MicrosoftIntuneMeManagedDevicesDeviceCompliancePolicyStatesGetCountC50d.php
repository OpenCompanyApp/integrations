<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Get the number of the resource.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /me/managedDevices/{managedDevice-id}/deviceCompliancePolicyStates/$count.
 */
class MicrosoftIntuneMeManagedDevicesDeviceCompliancePolicyStatesGetCountC50d extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_me_managed_devices_device_compliance_policy_states_get_count_c50d';
    protected const DESCRIPTION = 'Get the number of the resource\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /me/managedDevices/{managedDevice-id}/deviceCompliancePolicyStates/$count.';
    protected const PARAMETERS = ['managed_device_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `managedDevice-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/me/managedDevices/{managedDevice-id}/deviceCompliancePolicyStates/$count';
    protected const PATH_PARAMS = ['managedDevice-id' => 'managed_device_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
