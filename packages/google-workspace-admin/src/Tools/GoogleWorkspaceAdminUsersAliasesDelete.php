<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users Aliases Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/users/{userKey}/aliases/{alias}.
 */
class GoogleWorkspaceAdminUsersAliasesDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_aliases_delete';
    protected const DESCRIPTION = 'Users Aliases Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/users/{userKey}/aliases/{alias}
Removes an alias.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'alias' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `alias`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/admin/directory/v1/users/{userKey}/aliases/{alias}';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
  1 => 'alias',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}