<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Get exemptAppLockerFiles from deviceAppManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /deviceAppManagement/mdmWindowsInformationProtectionPolicies/{mdmWindowsInformationProtectionPolicy-id}/exemptAppLockerFiles/{windowsInformationProtectionAppLockerFile-id}.
 */
class MicrosoftIntuneDeviceAppManagementMdmWindowsInformationProtectionPoliciesGetExemptAppLockerFiles extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_app_management_mdm_windows_information_protection_policies_get_exempt_app_locker_files';
    protected const DESCRIPTION = 'Get exemptAppLockerFiles from deviceAppManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /deviceAppManagement/mdmWindowsInformationProtectionPolicies/{mdmWindowsInformationProtectionPolicy-id}/exemptAppLockerFiles/{windowsInformationProtectionAppLockerFile-id}.';
    protected const PARAMETERS = ['mdm_windows_information_protection_policy_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `mdmWindowsInformationProtectionPolicy-id`.'], 'windows_information_protection_app_locker_file_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `windowsInformationProtectionAppLockerFile-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/deviceAppManagement/mdmWindowsInformationProtectionPolicies/{mdmWindowsInformationProtectionPolicy-id}/exemptAppLockerFiles/{windowsInformationProtectionAppLockerFile-id}';
    protected const PATH_PARAMS = ['mdmWindowsInformationProtectionPolicy-id' => 'mdm_windows_information_protection_policy_id', 'windowsInformationProtectionAppLockerFile-id' => 'windows_information_protection_app_locker_file_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
