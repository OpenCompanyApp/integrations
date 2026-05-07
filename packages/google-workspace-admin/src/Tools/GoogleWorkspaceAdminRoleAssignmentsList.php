<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Role Assignments List.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customer}/roleassignments.
 */
class GoogleWorkspaceAdminRoleAssignmentsList extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_role_assignments_list';
    protected const DESCRIPTION = 'Role Assignments List

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customer}/roleassignments
Retrieves a paginated list of all roleAssignments.';
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
    'description' => 'Query string parameters accepted by the official Workspace Admin method. Known keys: includeIndirectRoleAssignments, pageToken, roleId, maxResults, userKey.',
  ),
  'includeIndirectRoleAssignments' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `includeIndirectRoleAssignments`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'roleId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `roleId`.',
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
    protected const PATH = '/admin/directory/v1/customer/{customer}/roleassignments';
    protected const PATH_PARAMS = array (
  0 => 'customer',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'includeIndirectRoleAssignments',
  1 => 'pageToken',
  2 => 'roleId',
  3 => 'maxResults',
  4 => 'userKey',
);
    protected const BODY_REQUIRED = false;
}