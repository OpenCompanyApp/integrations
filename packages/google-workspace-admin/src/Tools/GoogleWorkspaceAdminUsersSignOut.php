<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users Sign Out.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/users/{userKey}/signOut.
 */
class GoogleWorkspaceAdminUsersSignOut extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_sign_out';
    protected const DESCRIPTION = 'Users Sign Out

Official Workspace Admin endpoint: POST /admin/directory/v1/users/{userKey}/signOut
Signs a user out of all web and device sessions and reset their sign-in cookies.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/users/{userKey}/signOut';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}