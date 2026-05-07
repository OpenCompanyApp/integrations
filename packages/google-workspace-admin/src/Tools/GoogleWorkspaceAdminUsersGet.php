<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Users Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/users/{userKey}.
 */
class GoogleWorkspaceAdminUsersGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_users_get';
    protected const DESCRIPTION = 'Users Get

Official Workspace Admin endpoint: GET /admin/directory/v1/users/{userKey}
Retrieves a user.';
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
    'description' => 'Query string parameters accepted by the official Workspace Admin method. Known keys: projection, viewType, customFieldMask.',
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
  'customFieldMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `customFieldMask`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/users/{userKey}';
    protected const PATH_PARAMS = array (
  0 => 'userKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'projection',
  1 => 'viewType',
  2 => 'customFieldMask',
);
    protected const BODY_REQUIRED = false;
}