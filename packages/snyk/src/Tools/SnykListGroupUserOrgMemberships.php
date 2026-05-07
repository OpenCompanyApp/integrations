<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get list of org memberships of a group user.
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/org_memberships.
 */
class SnykListGroupUserOrgMemberships extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_group_user_org_memberships';
    protected const DESCRIPTION = 'Get list of org memberships of a group user

Official Snyk endpoint: GET /groups/{group_id}/org_memberships

Get list of org memberships of a group user #### Required permissions - `View Group Memberships (group.membership.read)` - `View Organizations (group.org.list)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The ID of the group',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `user_id` from the official Snyk API operation. The ID of the User',
  ),
  'org_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `org_name` from the official Snyk API operation. The Name of the org',
  ),
  'role_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `role_name` from the official Snyk API operation. Filter the response for results only with the specified role.',
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
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/org_memberships';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'user_id' => 'user_id',
  'org_name' => 'org_name',
  'role_name' => 'role_name',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
