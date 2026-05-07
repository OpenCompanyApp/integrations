<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create a new group level policy (Early Access).
 *
 * Maps to the official Snyk endpoint post /groups/{group_id}/policies.
 */
class SnykCreateGroupPolicy extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_group_policy';
    protected const DESCRIPTION = 'Create a new group level policy (Early Access)

Official Snyk endpoint: POST /groups/{group_id}/policies

Create one new group level policy. *Group level Policy APIs Access Notice:* Access to our Group level Policy APIs is currently restricted via "use-group-policy-apis" feature flag and will result in a 403 Forbidden error without the flag enabled. Please contact your account representative for eligibility requirements. #### Required permissions - `Create Policies (group.policy.create)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/groups/{group_id}/policies';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
