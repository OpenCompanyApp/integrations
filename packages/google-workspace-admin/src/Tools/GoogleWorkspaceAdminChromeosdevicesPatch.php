<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Chromeosdevices Patch.
 *
 * Maps to the official Workspace Admin endpoint PATCH /admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}.
 */
class GoogleWorkspaceAdminChromeosdevicesPatch extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_chromeosdevices_patch';
    protected const DESCRIPTION = 'Chromeosdevices Patch

Official Workspace Admin endpoint: PATCH /admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}
Updates a device\'s updatable properties, such as `annotatedUser`, `annotatedLocation`, `notes`, `orgUnitPath`, or `annotatedAssetId`.';
    protected const PARAMETERS = array (
  'customerId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customerId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'deviceId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `deviceId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Workspace Admin method. Known keys: projection.',
  ),
  'projection' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `projection`.',
    'enum' =>
    array (
      0 => 'BASIC',
      1 => 'FULL',
    ),
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `ChromeOsDevice` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
  1 => 'deviceId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'projection',
);
    protected const BODY_REQUIRED = true;
}