<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update a user's role in a group (Early Access).
 *
 * Maps to the official Snyk endpoint patch /groups/{group_id}/users/{id}.
 */
class SnykUpdateUser extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_user';
    protected const DESCRIPTION = 'Update a user\'s role in a group (Early Access)

Official Snyk endpoint: PATCH /groups/{group_id}/users/{id}

Update a user\'s membership of the group. To remove a user\'s membership, provide \'null\' as the membership parameter (see example). At present, only removing memberships is supported by this endpoint. To update a user\'s group membership, please use the UI or legacy API. #### Required permissions - `View Groups (group.read)` - `View users (group.user.read)` - `Remove users (group.user.remove)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The id of the group',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Snyk API operation. The id of the user',
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
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/groups/{group_id}/users/{id}';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
