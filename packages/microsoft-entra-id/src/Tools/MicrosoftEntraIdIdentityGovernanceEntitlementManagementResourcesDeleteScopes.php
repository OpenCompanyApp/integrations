<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete navigation property scopes for identityGovernance.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /identityGovernance/entitlementManagement/resources/{accessPackageResource-id}/scopes/{accessPackageResourceScope-id}.
 */
class MicrosoftEntraIdIdentityGovernanceEntitlementManagementResourcesDeleteScopes extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_entitlement_management_resources_delete_scopes';
    protected const DESCRIPTION = 'Delete navigation property scopes for identityGovernance\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /identityGovernance/entitlementManagement/resources/{accessPackageResource-id}/scopes/{accessPackageResourceScope-id}.';
    protected const PARAMETERS = ['access_package_resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResource-id`.'], 'access_package_resource_scope_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResourceScope-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/identityGovernance/entitlementManagement/resources/{accessPackageResource-id}/scopes/{accessPackageResourceScope-id}';
    protected const PATH_PARAMS = ['accessPackageResource-id' => 'access_package_resource_id', 'accessPackageResourceScope-id' => 'access_package_resource_scope_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
