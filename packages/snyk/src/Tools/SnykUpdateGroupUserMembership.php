<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update a role from a group membership.
 *
 * Maps to the official Snyk endpoint patch /groups/{group_id}/memberships/{membership_id}.
 */
class SnykUpdateGroupUserMembership extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_group_user_membership';
    protected const DESCRIPTION = 'Update a role from a group membership

Official Snyk endpoint: PATCH /groups/{group_id}/memberships/{membership_id}

Update a role from a group membership #### Required permissions - `Edit Group Memberships (group.membership.edit)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The ID of the group',
  ),
  'membership_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `membership_id` from the official Snyk API operation. The ID of the Group Membership',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/groups/{group_id}/memberships/{membership_id}';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
  'membership_id' => 'membership_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
