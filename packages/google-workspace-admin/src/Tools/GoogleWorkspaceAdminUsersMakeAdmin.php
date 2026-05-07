<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users Make Admin.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/users/{userKey}/makeAdmin.
 */
class GoogleWorkspaceAdminUsersMakeAdmin extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_make_admin';
    protected const DESCRIPTION = 'Users Make Admin

Official Workspace Admin endpoint: POST /admin/directory/v1/users/{userKey}/makeAdmin
Makes a user a super administrator.';
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
    'description' => 'JSON request body matching the official Workspace Admin `UserMakeAdmin` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/users/{userKey}/makeAdmin';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}