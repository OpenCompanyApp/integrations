<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Update the navigation property roles in identityGovernance.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /identityGovernance/entitlementManagement/resourceRequests/{accessPackageResourceRequest-id}/resource/scopes/{accessPackageResourceScope-id}/resource/roles/{accessPackageResourceRole-id}.
 */
class MicrosoftEntraIdIdentityGovernanceEntitlementManagementResourceRequestsResourceScopesResourceUpdateRoles extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_entitlement_management_resource_requests_resource_scopes_resource_update_roles';
    protected const DESCRIPTION = 'Update the navigation property roles in identityGovernance\\n\\nOfficial Microsoft Graph v1.0 endpoint: PATCH /identityGovernance/entitlementManagement/resourceRequests/{accessPackageResourceRequest-id}/resource/scopes/{accessPackageResourceScope-id}/resource/roles/{accessPackageResourceRole-id}.';
    protected const PARAMETERS = ['access_package_resource_request_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResourceRequest-id`.'], 'access_package_resource_scope_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResourceScope-id`.'], 'access_package_resource_role_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResourceRole-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/identityGovernance/entitlementManagement/resourceRequests/{accessPackageResourceRequest-id}/resource/scopes/{accessPackageResourceScope-id}/resource/roles/{accessPackageResourceRole-id}';
    protected const PATH_PARAMS = ['accessPackageResourceRequest-id' => 'access_package_resource_request_id', 'accessPackageResourceScope-id' => 'access_package_resource_scope_id', 'accessPackageResourceRole-id' => 'access_package_resource_role_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
