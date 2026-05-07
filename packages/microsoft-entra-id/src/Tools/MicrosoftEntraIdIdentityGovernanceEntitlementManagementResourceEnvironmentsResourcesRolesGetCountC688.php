<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get the number of the resource.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /identityGovernance/entitlementManagement/resourceEnvironments/{accessPackageResourceEnvironment-id}/resources/{accessPackageResource-id}/roles/$count.
 */
class MicrosoftEntraIdIdentityGovernanceEntitlementManagementResourceEnvironmentsResourcesRolesGetCountC688 extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_entitlement_management_resource_environments_resources_roles_get_count_c688';
    protected const DESCRIPTION = 'Get the number of the resource\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /identityGovernance/entitlementManagement/resourceEnvironments/{accessPackageResourceEnvironment-id}/resources/{accessPackageResource-id}/roles/$count.';
    protected const PARAMETERS = ['access_package_resource_environment_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResourceEnvironment-id`.'], 'access_package_resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResource-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/identityGovernance/entitlementManagement/resourceEnvironments/{accessPackageResourceEnvironment-id}/resources/{accessPackageResource-id}/roles/$count';
    protected const PATH_PARAMS = ['accessPackageResourceEnvironment-id' => 'access_package_resource_environment_id', 'accessPackageResource-id' => 'access_package_resource_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
