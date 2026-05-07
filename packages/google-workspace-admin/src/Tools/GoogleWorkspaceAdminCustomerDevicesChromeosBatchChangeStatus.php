<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Customer Devices Chromeos Batch Change Status.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/customer/{customerId}/devices/chromeos:batchChangeStatus.
 */
class GoogleWorkspaceAdminCustomerDevicesChromeosBatchChangeStatus extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_customer_devices_chromeos_batch_change_status';
    protected const DESCRIPTION = 'Customer Devices Chromeos Batch Change Status

Official Workspace Admin endpoint: POST /admin/directory/v1/customer/{customerId}/devices/chromeos:batchChangeStatus
Changes the status of a batch of ChromeOS devices.';
    protected const PARAMETERS = array (
  'customerId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customerId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `BatchChangeChromeOsDeviceStatusRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/devices/chromeos:batchChangeStatus';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}