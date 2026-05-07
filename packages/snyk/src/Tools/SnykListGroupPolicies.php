<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get group level policies (Early Access).
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/policies.
 */
class SnykListGroupPolicies extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_group_policies';
    protected const DESCRIPTION = 'Get group level policies (Early Access)

Official Snyk endpoint: GET /groups/{group_id}/policies

Get all policies for the requested group *Group level Policy APIs Access Notice:* Access to our Group level Policy APIs is currently restricted via "use-group-policy-apis" feature flag and will result in a 403 Forbidden error without the flag enabled. Please contact your account representative for eligibility requirements. #### Required permissions - `View Policies (group.policy.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. Group ID',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return the page of results immediately before this cursor',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/policies';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
