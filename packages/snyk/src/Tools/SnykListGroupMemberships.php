<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get all memberships of the group.
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/memberships.
 */
class SnykListGroupMemberships extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_group_memberships';
    protected const DESCRIPTION = 'Get all memberships of the group

Official Snyk endpoint: GET /groups/{group_id}/memberships

Returns all memberships of the group #### Required permissions - `View Group Memberships (group.membership.read)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The ID of the group',
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
  'sort_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort_by` from the official Snyk API operation. Which column to sort by.',
    'enum' =>
    array (
      0 => 'username',
      1 => 'user_display_name',
      2 => 'email',
      3 => 'login_method',
      4 => 'role_name',
    ),
  ),
  'sort_order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort_order` from the official Snyk API operation. Order in which results are returned.',
    'enum' =>
    array (
      0 => 'ASC',
      1 => 'DESC',
    ),
  ),
  'email' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `email` from the official Snyk API operation. Filter the response by Users that match the provided email',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `user_id` from the official Snyk API operation. Filter the response by Users that match the provided user ID',
  ),
  'username' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `username` from the official Snyk API operation. Filter the response by Users that match the provided username',
  ),
  'role_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `role_name` from the official Snyk API operation. Filter the response for results only with the specified role.',
  ),
  'include_group_membership_count' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `include_group_membership_count` from the official Snyk API operation. indicates whether the count of group memberships is included',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/memberships';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'version' => 'version',
  'sort_by' => 'sort_by',
  'sort_order' => 'sort_order',
  'email' => 'email',
  'user_id' => 'user_id',
  'username' => 'username',
  'role_name' => 'role_name',
  'include_group_membership_count' => 'include_group_membership_count',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
