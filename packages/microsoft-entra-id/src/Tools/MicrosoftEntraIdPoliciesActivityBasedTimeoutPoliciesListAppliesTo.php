<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get appliesTo from policies.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /policies/activityBasedTimeoutPolicies/{activityBasedTimeoutPolicy-id}/appliesTo.
 */
class MicrosoftEntraIdPoliciesActivityBasedTimeoutPoliciesListAppliesTo extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_policies_activity_based_timeout_policies_list_applies_to';
    protected const DESCRIPTION = 'Get appliesTo from policies\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /policies/activityBasedTimeoutPolicies/{activityBasedTimeoutPolicy-id}/appliesTo.';
    protected const PARAMETERS = ['activity_based_timeout_policy_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `activityBasedTimeoutPolicy-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/policies/activityBasedTimeoutPolicies/{activityBasedTimeoutPolicy-id}/appliesTo';
    protected const PATH_PARAMS = ['activityBasedTimeoutPolicy-id' => 'activity_based_timeout_policy_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
