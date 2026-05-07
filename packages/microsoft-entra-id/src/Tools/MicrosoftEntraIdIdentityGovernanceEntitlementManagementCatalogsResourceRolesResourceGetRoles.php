<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get roles from identityGovernance.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /identityGovernance/entitlementManagement/catalogs/{accessPackageCatalog-id}/resourceRoles/{accessPackageResourceRole-id}/resource/roles/{accessPackageResourceRole-id1}.
 */
class MicrosoftEntraIdIdentityGovernanceEntitlementManagementCatalogsResourceRolesResourceGetRoles extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_entitlement_management_catalogs_resource_roles_resource_get_roles';
    protected const DESCRIPTION = 'Get roles from identityGovernance\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /identityGovernance/entitlementManagement/catalogs/{accessPackageCatalog-id}/resourceRoles/{accessPackageResourceRole-id}/resource/roles/{accessPackageResourceRole-id1}.';
    protected const PARAMETERS = ['access_package_catalog_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageCatalog-id`.'], 'access_package_resource_role_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResourceRole-id`.'], 'access_package_resource_role_id1' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResourceRole-id1`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/identityGovernance/entitlementManagement/catalogs/{accessPackageCatalog-id}/resourceRoles/{accessPackageResourceRole-id}/resource/roles/{accessPackageResourceRole-id1}';
    protected const PATH_PARAMS = ['accessPackageCatalog-id' => 'access_package_catalog_id', 'accessPackageResourceRole-id' => 'access_package_resource_role_id', 'accessPackageResourceRole-id1' => 'access_package_resource_role_id1'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
