<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Orgunits Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/customer/{customerId}/orgunits/{+orgUnitPath}.
 */
class GoogleWorkspaceAdminOrgunitsDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_orgunits_delete';
    protected const DESCRIPTION = 'Orgunits Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/customer/{customerId}/orgunits/{+orgUnitPath}
Removes an organizational unit.';
    protected const PARAMETERS = array (
  'customerId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customerId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'orgUnitPath' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgUnitPath`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/orgunits/{+orgUnitPath}';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
  1 => 'orgUnitPath',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'orgUnitPath',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}