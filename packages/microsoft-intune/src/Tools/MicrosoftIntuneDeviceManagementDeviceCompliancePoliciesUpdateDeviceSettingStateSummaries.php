<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Update the navigation property deviceSettingStateSummaries in deviceManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /deviceManagement/deviceCompliancePolicies/{deviceCompliancePolicy-id}/deviceSettingStateSummaries/{settingStateDeviceSummary-id}.
 */
class MicrosoftIntuneDeviceManagementDeviceCompliancePoliciesUpdateDeviceSettingStateSummaries extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_device_compliance_policies_update_device_setting_state_summaries';
    protected const DESCRIPTION = 'Update the navigation property deviceSettingStateSummaries in deviceManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: PATCH /deviceManagement/deviceCompliancePolicies/{deviceCompliancePolicy-id}/deviceSettingStateSummaries/{settingStateDeviceSummary-id}.';
    protected const PARAMETERS = ['device_compliance_policy_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `deviceCompliancePolicy-id`.'], 'setting_state_device_summary_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `settingStateDeviceSummary-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/deviceManagement/deviceCompliancePolicies/{deviceCompliancePolicy-id}/deviceSettingStateSummaries/{settingStateDeviceSummary-id}';
    protected const PATH_PARAMS = ['deviceCompliancePolicy-id' => 'device_compliance_policy_id', 'settingStateDeviceSummary-id' => 'setting_state_device_summary_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
