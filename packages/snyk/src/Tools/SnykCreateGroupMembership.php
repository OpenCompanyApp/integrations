<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create a group membership for a user with role.
 *
 * Maps to the official Snyk endpoint post /groups/{group_id}/memberships.
 */
class SnykCreateGroupMembership extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_group_membership';
    protected const DESCRIPTION = 'Create a group membership for a user with role

Official Snyk endpoint: POST /groups/{group_id}/memberships

Create a group membership for a user with role #### Required permissions - `Add Group Memberships (group.membership.add)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The ID of the group',
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
    protected const METHOD = 'post';
    protected const PATH = '/groups/{group_id}/memberships';
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
