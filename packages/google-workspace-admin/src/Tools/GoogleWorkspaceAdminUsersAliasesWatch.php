<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users Aliases Watch.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/users/{userKey}/aliases/watch.
 */
class GoogleWorkspaceAdminUsersAliasesWatch extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_aliases_watch';
    protected const DESCRIPTION = 'Users Aliases Watch

Official Workspace Admin endpoint: POST /admin/directory/v1/users/{userKey}/aliases/watch
Watches for changes in users list.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `Channel` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/users/{userKey}/aliases/watch';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'event',
);
    protected const BODY_REQUIRED = true;
}