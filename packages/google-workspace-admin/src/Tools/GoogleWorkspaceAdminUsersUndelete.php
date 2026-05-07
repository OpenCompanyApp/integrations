<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users Undelete.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/users/{userKey}/undelete.
 */
class GoogleWorkspaceAdminUsersUndelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_undelete';
    protected const DESCRIPTION = 'Users Undelete

Official Workspace Admin endpoint: POST /admin/directory/v1/users/{userKey}/undelete
Undeletes a deleted user.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `UserUndelete` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/users/{userKey}/undelete';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}