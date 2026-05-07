<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Mobiledevices Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customerId}/devices/mobile/{resourceId}.
 */
class GoogleWorkspaceAdminMobiledevicesGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_mobiledevices_get';
    protected const DESCRIPTION = 'Mobiledevices Get

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customerId}/devices/mobile/{resourceId}
Retrieves a mobile device\'s properties.';
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/devices/mobile/{resourceId}';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
  1 => 'resourceId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'projection',
);
    protected const BODY_REQUIRED = false;
}