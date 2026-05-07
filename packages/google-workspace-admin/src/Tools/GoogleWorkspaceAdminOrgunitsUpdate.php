<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Orgunits Update.
 *
 * Maps to the official Workspace Admin endpoint PUT /admin/directory/v1/customer/{customerId}/orgunits/{+orgUnitPath}.
 */
class GoogleWorkspaceAdminOrgunitsUpdate extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_orgunits_update';
    protected const DESCRIPTION = 'Orgunits Update

Official Workspace Admin endpoint: PUT /admin/directory/v1/customer/{customerId}/orgunits/{+orgUnitPath}
Updates an organizational unit.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `OrgUnit` schema.',
  ),
);
    protected const METHOD = 'PUT';
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
    protected const BODY_REQUIRED = true;
}