<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Chromeosdevices Move Devices To Ou.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/customer/{customerId}/devices/chromeos/moveDevicesToOu.
 */
class GoogleWorkspaceAdminChromeosdevicesMoveDevicesToOu extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_chromeosdevices_move_devices_to_ou';
    protected const DESCRIPTION = 'Chromeosdevices Move Devices To Ou

Official Workspace Admin endpoint: POST /admin/directory/v1/customer/{customerId}/devices/chromeos/moveDevicesToOu
Moves or inserts multiple Chrome OS devices to an organizational unit.';
    protected const PARAMETERS = array (
  'customerId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customerId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Workspace Admin method. Known keys: orgUnitPath.',
  ),
  'orgUnitPath' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orgUnitPath`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `ChromeOsMoveDevicesToOu` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/devices/chromeos/moveDevicesToOu';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'orgUnitPath',
);
    protected const BODY_REQUIRED = true;
}