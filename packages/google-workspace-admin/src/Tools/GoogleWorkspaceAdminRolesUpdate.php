<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Roles Update.
 *
 * Maps to the official Workspace Admin endpoint PUT /admin/directory/v1/customer/{customer}/roles/{roleId}.
 */
class GoogleWorkspaceAdminRolesUpdate extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_roles_update';
    protected const DESCRIPTION = 'Roles Update

Official Workspace Admin endpoint: PUT /admin/directory/v1/customer/{customer}/roles/{roleId}
Updates a role.';
    protected const PARAMETERS = array (
  'customer' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customer`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'roleId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `roleId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `Role` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/admin/directory/v1/customer/{customer}/roles/{roleId}';
    protected const PATH_PARAMS = array (
  0 => 'customer',
  1 => 'roleId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}