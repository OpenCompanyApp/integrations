<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Delete navigation property deviceStatuses for deviceManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /deviceManagement/deviceCompliancePolicies/{deviceCompliancePolicy-id}/deviceStatuses/{deviceComplianceDeviceStatus-id}.
 */
class MicrosoftIntuneDeviceManagementDeviceCompliancePoliciesDeleteDeviceStatuses extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_device_compliance_policies_delete_device_statuses';
    protected const DESCRIPTION = 'Delete navigation property deviceStatuses for deviceManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /deviceManagement/deviceCompliancePolicies/{deviceCompliancePolicy-id}/deviceStatuses/{deviceComplianceDeviceStatus-id}.';
    protected const PARAMETERS = ['device_compliance_policy_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `deviceCompliancePolicy-id`.'], 'device_compliance_device_status_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `deviceComplianceDeviceStatus-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/deviceManagement/deviceCompliancePolicies/{deviceCompliancePolicy-id}/deviceStatuses/{deviceComplianceDeviceStatus-id}';
    protected const PATH_PARAMS = ['deviceCompliancePolicy-id' => 'device_compliance_policy_id', 'deviceComplianceDeviceStatus-id' => 'device_compliance_device_status_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
