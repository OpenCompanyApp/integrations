<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Invoke action reprocess.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /identityGovernance/entitlementManagement/assignments/{accessPackageAssignment-id}/reprocess.
 */
class MicrosoftEntraIdIdentityGovernanceEntitlementManagementAssignmentsAccessPackageAssignmentReprocess extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_entitlement_management_assignments_access_package_assignment_reprocess';
    protected const DESCRIPTION = 'Invoke action reprocess\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /identityGovernance/entitlementManagement/assignments/{accessPackageAssignment-id}/reprocess.';
    protected const PARAMETERS = ['access_package_assignment_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `accessPackageAssignment-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'POST';
    protected const PATH = '/identityGovernance/entitlementManagement/assignments/{accessPackageAssignment-id}/reprocess';
    protected const PATH_PARAMS = ['accessPackageAssignment-id' => 'access_package_assignment_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
