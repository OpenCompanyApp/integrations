<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Mobiledevices Action.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/customer/{customerId}/devices/mobile/{resourceId}/action.
 */
class GoogleWorkspaceAdminMobiledevicesAction extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_mobiledevices_action';
    protected const DESCRIPTION = 'Mobiledevices Action

Official Workspace Admin endpoint: POST /admin/directory/v1/customer/{customerId}/devices/mobile/{resourceId}/action
Takes an action that affects a mobile device.';
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
    'description' => 'JSON request body matching the official Workspace Admin `MobileDeviceAction` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/devices/mobile/{resourceId}/action';
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