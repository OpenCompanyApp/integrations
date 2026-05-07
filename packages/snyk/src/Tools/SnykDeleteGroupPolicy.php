<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete an group-level policy (Early Access).
 *
 * Maps to the official Snyk endpoint delete /groups/{group_id}/policies/{policy_id}.
 */
class SnykDeleteGroupPolicy extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_group_policy';
    protected const DESCRIPTION = 'Delete an group-level policy (Early Access)

Official Snyk endpoint: DELETE /groups/{group_id}/policies/{policy_id}

Delete an existing group-level policy. *Group level Policy APIs Access Notice:* Access to our Group level Policy APIs is currently restricted via "use-group-policy-apis" feature flag and will result in a 403 Forbidden error without the flag enabled. Please contact your account representative for eligibility requirements. #### Required permissions - `Delete Policies (group.policy.delete)`';
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
);
    protected const METHOD = 'delete';
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
