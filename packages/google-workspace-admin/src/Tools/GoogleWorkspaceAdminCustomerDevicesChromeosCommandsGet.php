<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Customer Devices Chromeos Commands Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}/commands/{commandId}.
 */
class GoogleWorkspaceAdminCustomerDevicesChromeosCommandsGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_customer_devices_chromeos_commands_get';
    protected const DESCRIPTION = 'Customer Devices Chromeos Commands Get

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}/commands/{commandId}
Gets command data a specific command issued to the device.';
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
  'commandId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `commandId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}/commands/{commandId}';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
  1 => 'deviceId',
  2 => 'commandId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}