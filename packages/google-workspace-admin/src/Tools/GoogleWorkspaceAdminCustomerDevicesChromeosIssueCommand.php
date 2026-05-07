<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Customer Devices Chromeos Issue Command.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}:issueCommand.
 */
class GoogleWorkspaceAdminCustomerDevicesChromeosIssueCommand extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_customer_devices_chromeos_issue_command';
    protected const DESCRIPTION = 'Customer Devices Chromeos Issue Command

Official Workspace Admin endpoint: POST /admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}:issueCommand
Issues a command for the device to execute.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `DirectoryChromeosdevicesIssueCommandRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/devices/chromeos/{deviceId}:issueCommand';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
  1 => 'deviceId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}