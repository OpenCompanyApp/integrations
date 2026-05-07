<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Mobiledevices Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/customer/{customerId}/devices/mobile/{resourceId}.
 */
class GoogleWorkspaceAdminMobiledevicesDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_mobiledevices_delete';
    protected const DESCRIPTION = 'Mobiledevices Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/customer/{customerId}/devices/mobile/{resourceId}
Removes a mobile device.';
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
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/devices/mobile/{resourceId}';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
  1 => 'resourceId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}