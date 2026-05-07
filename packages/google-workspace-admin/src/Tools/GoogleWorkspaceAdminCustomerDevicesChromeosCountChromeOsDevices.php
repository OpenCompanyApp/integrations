<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Customer Devices Chromeos Count Chrome Os Devices.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customerId}/devices/chromeos:countChromeOsDevices.
 */
class GoogleWorkspaceAdminCustomerDevicesChromeosCountChromeOsDevices extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_customer_devices_chromeos_count_chrome_os_devices';
    protected const DESCRIPTION = 'Customer Devices Chromeos Count Chrome Os Devices

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customerId}/devices/chromeos:countChromeOsDevices
Counts ChromeOS devices matching the request.';
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
    'description' => 'Query string parameters accepted by the official Workspace Admin method. Known keys: orgUnitPath, includeChildOrgunits, filter.',
  ),
  'orgUnitPath' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orgUnitPath`.',
  ),
  'includeChildOrgunits' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `includeChildOrgunits`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/devices/chromeos:countChromeOsDevices';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'orgUnitPath',
  1 => 'includeChildOrgunits',
  2 => 'filter',
);
    protected const BODY_REQUIRED = false;
}