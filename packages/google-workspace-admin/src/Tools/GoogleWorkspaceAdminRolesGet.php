<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Roles Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customer}/roles/{roleId}.
 */
class GoogleWorkspaceAdminRolesGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_roles_get';
    protected const DESCRIPTION = 'Roles Get

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customer}/roles/{roleId}
Retrieves a role.';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customer}/roles/{roleId}';
    protected const PATH_PARAMS = array (
  0 => 'customer',
  1 => 'roleId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}