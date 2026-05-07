<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Create accessPackageCustomWorkflowExtension.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /identityGovernance/entitlementManagement/catalogs/{accessPackageCatalog-id}/customWorkflowExtensions.
 */
class MicrosoftEntraIdIdentityGovernanceEntitlementManagementCatalogsCreateCustomWorkflowExtensions extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_entitlement_management_catalogs_create_custom_workflow_extensions';
    protected const DESCRIPTION = 'Create accessPackageCustomWorkflowExtension\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /identityGovernance/entitlementManagement/catalogs/{accessPackageCatalog-id}/customWorkflowExtensions.';
    protected const PARAMETERS = ['access_package_catalog_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageCatalog-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/identityGovernance/entitlementManagement/catalogs/{accessPackageCatalog-id}/customWorkflowExtensions';
    protected const PATH_PARAMS = ['accessPackageCatalog-id' => 'access_package_catalog_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
