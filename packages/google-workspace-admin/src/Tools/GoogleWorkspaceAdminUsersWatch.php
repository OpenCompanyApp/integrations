<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users Watch.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/users/watch.
 */
class GoogleWorkspaceAdminUsersWatch extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_watch';
    protected const DESCRIPTION = 'Users Watch

Official Workspace Admin endpoint: POST /admin/directory/v1/users/watch
Watches for changes in users list.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `query`.',
  ),
  'viewType' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `viewType`.',
    'enum' =>
    array (
      0 => 'admin_view',
      1 => 'domain_public',
    ),
  ),
  'projection' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `projection`.',
    'enum' =>
    array (
      0 => 'basic',
      1 => 'custom',
      2 => 'full',
    ),
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
      2 => 'makeAdmin',
      3 => 'undelete',
      4 => 'update',
    ),
  ),
  'showDeleted' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `showDeleted`.',
  ),
  'customer' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `customer`.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxResults`.',
  ),
  'customFieldMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `customFieldMask`.',
  ),
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderBy`.',
    'enum' =>
    array (
      0 => 'email',
      1 => 'familyName',
      2 => 'givenName',
    ),
  ),
  'sortOrder' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sortOrder`.',
    'enum' =>
    array (
      0 => 'ASCENDING',
      1 => 'DESCENDING',
    ),
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'domain' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `domain`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `Channel` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/users/watch';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'viewType',
  1 => 'projection',
  2 => 'query',
  3 => 'event',
  4 => 'showDeleted',
  5 => 'customer',
  6 => 'maxResults',
  7 => 'customFieldMask',
  8 => 'orderBy',
  9 => 'sortOrder',
  10 => 'pageToken',
  11 => 'domain',
);
    protected const BODY_REQUIRED = true;
}