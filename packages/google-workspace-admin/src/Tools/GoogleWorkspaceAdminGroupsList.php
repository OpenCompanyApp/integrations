<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Groups List.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/groups.
 */
class GoogleWorkspaceAdminGroupsList extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_groups_list';
    protected const DESCRIPTION = 'Groups List

Official Workspace Admin endpoint: GET /admin/directory/v1/groups
Retrieves all groups of a domain or of a user given a userKey (paginated).';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `query`.',
  ),
  'domain' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `domain`.',
  ),
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderBy`.',
    'enum' =>
    array (
      0 => 'email',
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
  'userKey' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `userKey`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/groups';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'domain',
  1 => 'orderBy',
  2 => 'sortOrder',
  3 => 'pageToken',
  4 => 'query',
  5 => 'customer',
  6 => 'maxResults',
  7 => 'userKey',
);
    protected const BODY_REQUIRED = false;
}