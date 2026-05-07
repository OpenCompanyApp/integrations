<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users List.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/users.
 */
class GoogleWorkspaceAdminUsersList extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_list';
    protected const DESCRIPTION = 'Users List

Official Workspace Admin endpoint: GET /admin/directory/v1/users
Retrieves a paginated list of either deleted users or all users in a domain.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `query`.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/users';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'showDeleted',
  1 => 'customer',
  2 => 'maxResults',
  3 => 'customFieldMask',
  4 => 'orderBy',
  5 => 'sortOrder',
  6 => 'pageToken',
  7 => 'domain',
  8 => 'viewType',
  9 => 'projection',
  10 => 'query',
  11 => 'event',
);
    protected const BODY_REQUIRED = false;
}