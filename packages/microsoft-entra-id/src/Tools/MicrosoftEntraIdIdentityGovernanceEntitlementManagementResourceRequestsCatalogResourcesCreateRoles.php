<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Create new navigation property to roles for identityGovernance.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /identityGovernance/entitlementManagement/resourceRequests/{accessPackageResourceRequest-id}/catalog/resources/{accessPackageResource-id}/roles.
 */
class MicrosoftEntraIdIdentityGovernanceEntitlementManagementResourceRequestsCatalogResourcesCreateRoles extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_entitlement_management_resource_requests_catalog_resources_create_roles';
    protected const DESCRIPTION = 'Create new navigation property to roles for identityGovernance\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /identityGovernance/entitlementManagement/resourceRequests/{accessPackageResourceRequest-id}/catalog/resources/{accessPackageResource-id}/roles.';
    protected const PARAMETERS = ['access_package_resource_request_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResourceRequest-id`.'], 'access_package_resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageResource-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/identityGovernance/entitlementManagement/resourceRequests/{accessPackageResourceRequest-id}/catalog/resources/{accessPackageResource-id}/roles';
    protected const PATH_PARAMS = ['accessPackageResourceRequest-id' => 'access_package_resource_request_id', 'accessPackageResource-id' => 'access_package_resource_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
