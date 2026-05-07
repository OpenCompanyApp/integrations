<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Chromeosdevices Action.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/customer/{customerId}/devices/chromeos/{resourceId}/action.
 */
class GoogleWorkspaceAdminChromeosdevicesAction extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_chromeosdevices_action';
    protected const DESCRIPTION = 'Chromeosdevices Action

Official Workspace Admin endpoint: POST /admin/directory/v1/customer/{customerId}/devices/chromeos/{resourceId}/action
Use [BatchChangeChromeOsDeviceStatus](https://developers.';
    protected const PARAMETERS = array (
  'customerId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customerId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'resourceId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resourceId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `ChromeOsDeviceAction` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/devices/chromeos/{resourceId}/action';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
  1 => 'resourceId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}