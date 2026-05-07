<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete a user from a Group SSO connection (Early Access).
 *
 * Maps to the official Snyk endpoint delete /groups/{group_id}/sso_connections/{sso_id}/users/{user_id}.
 */
class SnykDeleteUser extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_user';
    protected const DESCRIPTION = 'Delete a user from a Group SSO connection (Early Access)

Official Snyk endpoint: DELETE /groups/{group_id}/sso_connections/{sso_id}/users/{user_id}

Deletes a user from a Group SSO connection #### Required permissions - `View SSO settings (group.sso.read)` - `Delete users (group.user.delete)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The ID of the group',
  ),
  'sso_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `sso_id` from the official Snyk API operation. The ID of the SSO',
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `user_id` from the official Snyk API operation. The ID of the User',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/groups/{group_id}/sso_connections/{sso_id}/users/{user_id}';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
  'sso_id' => 'sso_id',
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
