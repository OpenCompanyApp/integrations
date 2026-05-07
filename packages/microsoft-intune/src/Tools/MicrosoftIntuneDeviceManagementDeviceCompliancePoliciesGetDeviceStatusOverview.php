<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Get deviceStatusOverview from deviceManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /deviceManagement/deviceCompliancePolicies/{deviceCompliancePolicy-id}/deviceStatusOverview.
 */
class MicrosoftIntuneDeviceManagementDeviceCompliancePoliciesGetDeviceStatusOverview extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_device_compliance_policies_get_device_status_overview';
    protected const DESCRIPTION = 'Get deviceStatusOverview from deviceManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /deviceManagement/deviceCompliancePolicies/{deviceCompliancePolicy-id}/deviceStatusOverview.';
    protected const PARAMETERS = ['device_compliance_policy_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `deviceCompliancePolicy-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/deviceManagement/deviceCompliancePolicies/{deviceCompliancePolicy-id}/deviceStatusOverview';
    protected const PATH_PARAMS = ['deviceCompliancePolicy-id' => 'device_compliance_policy_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
