<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Roles Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/customer/{customer}/roles/{roleId}.
 */
class GoogleWorkspaceAdminRolesDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_roles_delete';
    protected const DESCRIPTION = 'Roles Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/customer/{customer}/roles/{roleId}
Deletes a role.';
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
    protected const METHOD = 'DELETE';
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