<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update a group-level policy (Early Access).
 *
 * Maps to the official Snyk endpoint patch /groups/{group_id}/policies/{policy_id}.
 */
class SnykUpdateGroupPolicy extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_group_policy';
    protected const DESCRIPTION = 'Update a group-level policy (Early Access)

Official Snyk endpoint: PATCH /groups/{group_id}/policies/{policy_id}

Update the group-level policy. *Group level Policy APIs Access Notice:* Access to our Group level Policy APIs is currently restricted via "use-group-policy-apis" feature flag and will result in a 403 Forbidden error without the flag enabled. Please contact your account representative for eligibility requirements. #### Required permissions - `Edit Policies (group.policy.edit)`';
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
  'policy_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `policy_id` from the official Snyk API operation. Policy ID',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/groups/{group_id}/policies/{policy_id}';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
  'policy_id' => 'policy_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
