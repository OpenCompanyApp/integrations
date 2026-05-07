<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users Insert.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/users.
 */
class GoogleWorkspaceAdminUsersInsert extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_insert';
    protected const DESCRIPTION = 'Users Insert

Official Workspace Admin endpoint: POST /admin/directory/v1/users
Creates a user.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Workspace Admin method. Known keys: resolveConflictAccount.',
  ),
  'resolveConflictAccount' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `resolveConflictAccount`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `User` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/users';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'resolveConflictAccount',
);
    protected const BODY_REQUIRED = true;
}