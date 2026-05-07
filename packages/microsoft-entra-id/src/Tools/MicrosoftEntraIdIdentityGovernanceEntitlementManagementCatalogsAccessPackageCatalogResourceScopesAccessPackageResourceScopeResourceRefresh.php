<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Invoke action refresh.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /identityGovernance/entitlementManagement/catalogs/{accessPackageCatalog-id}/resourceScopes/{accessPackageResourceScope-id}/resource/refresh.
 */
class MicrosoftEntraIdIdentityGovernanceEntitlementManagementCatalogsAccessPackageCatalogResourceScopesAccessPackageResourceScopeResourceRefresh extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_entitlement_management_catalogs_access_package_catalog_resource_scopes_access_package_resource_scope_resource_refresh';
    protected const DESCRIPTION = 'Invoke action refresh\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /identityGovernance/entitlementManagement/catalogs/{accessPackageCatalog-id}/resourceScopes/{accessPackageResourceScope-id}/resource/refresh.';
    protected const PARAMETERS = ['access_package_catalog_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageCatalog-id`.'], 'access_package_resource_scope_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResourceScope-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'POST';
    protected const PATH = '/identityGovernance/entitlementManagement/catalogs/{accessPackageCatalog-id}/resourceScopes/{accessPackageResourceScope-id}/resource/refresh';
    protected const PATH_PARAMS = ['accessPackageCatalog-id' => 'access_package_catalog_id', 'accessPackageResourceScope-id' => 'access_package_resource_scope_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
