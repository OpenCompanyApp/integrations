<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Chromeosdevices List.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customerId}/devices/chromeos.
 */
class GoogleWorkspaceAdminChromeosdevicesList extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_chromeosdevices_list';
    protected const DESCRIPTION = 'Chromeosdevices List

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customerId}/devices/chromeos
Retrieves a paginated list of Chrome OS devices within an account.';
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
  'orgUnitPath' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orgUnitPath`.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `maxResults`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderBy`.',
    'enum' =>
    array (
      0 => 'annotatedLocation',
      1 => 'annotatedUser',
      2 => 'lastSync',
      3 => 'notes',
      4 => 'serialNumber',
      5 => 'status',
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
  'includeChildOrgunits' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `includeChildOrgunits`.',
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
    protected const PATH = '/admin/directory/v1/customer/{customerId}/devices/chromeos';
    protected const PATH_PARAMS = array (
  0 => 'customerId',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'orgUnitPath',
  1 => 'maxResults',
  2 => 'pageToken',
  3 => 'orderBy',
  4 => 'sortOrder',
  5 => 'includeChildOrgunits',
  6 => 'projection',
  7 => 'query',
);
    protected const BODY_REQUIRED = false;
}