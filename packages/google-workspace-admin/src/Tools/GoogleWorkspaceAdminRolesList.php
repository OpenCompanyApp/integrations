<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Roles List.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customer}/roles.
 */
class GoogleWorkspaceAdminRolesList extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_roles_list';
    protected const DESCRIPTION = 'Roles List

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customer}/roles
Retrieves a paginated list of all the roles in a domain.';
    protected const PARAMETERS = array (
  'customer' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customer`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Workspace Admin method. Known keys: maxResults, pageToken.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxResults`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customer}/roles';
    protected const PATH_PARAMS = array (
  0 => 'customer',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'maxResults',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}