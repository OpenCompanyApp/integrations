<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete navigation property roles for identityGovernance.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /identityGovernance/entitlementManagement/accessPackages/{accessPackage-id}/resourceRoleScopes/{accessPackageResourceRoleScope-id}/role/resource/roles/{accessPackageResourceRole-id}.
 */
class MicrosoftEntraIdIdentityGovernanceEntitlementManagementAccessPackagesResourceRoleScopesRoleResourceDeleteRoles extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_entitlement_management_access_packages_resource_role_scopes_role_resource_delete_roles';
    protected const DESCRIPTION = 'Delete navigation property roles for identityGovernance\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /identityGovernance/entitlementManagement/accessPackages/{accessPackage-id}/resourceRoleScopes/{accessPackageResourceRoleScope-id}/role/resource/roles/{accessPackageResourceRole-id}.';
    protected const PARAMETERS = ['access_package_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackage-id`.'], 'access_package_resource_role_scope_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResourceRoleScope-id`.'], 'access_package_resource_role_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResourceRole-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/identityGovernance/entitlementManagement/accessPackages/{accessPackage-id}/resourceRoleScopes/{accessPackageResourceRoleScope-id}/role/resource/roles/{accessPackageResourceRole-id}';
    protected const PATH_PARAMS = ['accessPackage-id' => 'access_package_id', 'accessPackageResourceRoleScope-id' => 'access_package_resource_role_scope_id', 'accessPackageResourceRole-id' => 'access_package_resource_role_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
