<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Delete navigation property deploymentSummary for deviceAppManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /deviceAppManagement/androidManagedAppProtections/{androidManagedAppProtection-id}/deploymentSummary.
 */
class MicrosoftIntuneDeviceAppManagementAndroidManagedAppProtectionsDeleteDeploymentSummary extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_app_management_android_managed_app_protections_delete_deployment_summary';
    protected const DESCRIPTION = 'Delete navigation property deploymentSummary for deviceAppManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /deviceAppManagement/androidManagedAppProtections/{androidManagedAppProtection-id}/deploymentSummary.';
    protected const PARAMETERS = ['android_managed_app_protection_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `androidManagedAppProtection-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/deviceAppManagement/androidManagedAppProtections/{androidManagedAppProtection-id}/deploymentSummary';
    protected const PATH_PARAMS = ['androidManagedAppProtection-id' => 'android_managed_app_protection_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
