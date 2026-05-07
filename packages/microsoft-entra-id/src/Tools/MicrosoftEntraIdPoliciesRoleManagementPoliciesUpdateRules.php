<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Update unifiedRoleManagementPolicyRule.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /policies/roleManagementPolicies/{unifiedRoleManagementPolicy-id}/rules/{unifiedRoleManagementPolicyRule-id}.
 */
class MicrosoftEntraIdPoliciesRoleManagementPoliciesUpdateRules extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_policies_role_management_policies_update_rules';
    protected const DESCRIPTION = 'Update unifiedRoleManagementPolicyRule\\n\\nOfficial Microsoft Graph v1.0 endpoint: PATCH /policies/roleManagementPolicies/{unifiedRoleManagementPolicy-id}/rules/{unifiedRoleManagementPolicyRule-id}.';
    protected const PARAMETERS = ['unified_role_management_policy_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `unifiedRoleManagementPolicy-id`.'], 'unified_role_management_policy_rule_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `unifiedRoleManagementPolicyRule-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/policies/roleManagementPolicies/{unifiedRoleManagementPolicy-id}/rules/{unifiedRoleManagementPolicyRule-id}';
    protected const PATH_PARAMS = ['unifiedRoleManagementPolicy-id' => 'unified_role_management_policy_id', 'unifiedRoleManagementPolicyRule-id' => 'unified_role_management_policy_rule_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
