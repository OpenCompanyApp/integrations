<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Customers Chrome Printers List.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/{+parent}/chrome/printers.
 */
class GoogleWorkspaceAdminCustomersChromePrintersList extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_customers_chrome_printers_list';
    protected const DESCRIPTION = 'Customers Chrome Printers List

Official Workspace Admin endpoint: GET /admin/directory/v1/{+parent}/chrome/printers
List printers configs.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Workspace Admin method. Known keys: orgUnitId, orderBy, pageToken, pageSize, filter.',
  ),
  'orgUnitId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orgUnitId`.',
  ),
  'orderBy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `orderBy`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/{+parent}/chrome/printers';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'orgUnitId',
  1 => 'orderBy',
  2 => 'pageToken',
  3 => 'pageSize',
  4 => 'filter',
);
    protected const BODY_REQUIRED = false;
}