<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users Aliases List.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/users/{userKey}/aliases.
 */
class GoogleWorkspaceAdminUsersAliasesList extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_aliases_list';
    protected const DESCRIPTION = 'Users Aliases List

Official Workspace Admin endpoint: GET /admin/directory/v1/users/{userKey}/aliases
Lists all aliases for a user.';
    protected const PARAMETERS = array (
  'userKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Workspace Admin method. Known keys: event.',
  ),
  'event' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `event`.',
    'enum' =>
    array (
      0 => 'add',
      1 => 'delete',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/users/{userKey}/aliases';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'event',
);
    protected const BODY_REQUIRED = false;
}