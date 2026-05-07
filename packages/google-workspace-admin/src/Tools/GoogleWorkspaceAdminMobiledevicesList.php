<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Mobiledevices List.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customerId}/devices/mobile.
 */
class GoogleWorkspaceAdminMobiledevicesList extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_mobiledevices_list';
    protected const DESCRIPTION = 'Mobiledevices List

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customerId}/devices/mobile
Retrieves a paginated list of all user-owned mobile devices for an account.';
    protected const PARAMETERS = array (
  'customerId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customerId`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'query' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `query`.',
  ),
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderBy`.',
    'enum' =>
    array (
      0 => 'deviceId',
      1 => 'email',
      2 => 'lastSync',
      3 => 'model',
      4 => 'name',
      5 => 'os',
      6 => 'status',
      7 => 'type',
    ),
  ),
  'sortOrder' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sortOrder`.',
    'enum' =>
    array (
      0 => 'ASCENDING',
      1 => 'DESCENDING',
    ),
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
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
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxResults`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customerId}/devices/mobile';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'orderBy',
  1 => 'sortOrder',
  2 => 'pageToken',
  3 => 'projection',
  4 => 'query',
  5 => 'maxResults',
);
    protected const BODY_REQUIRED = false;
}