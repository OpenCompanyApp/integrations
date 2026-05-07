<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Customers Chrome Print Servers Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/{+name}.
 */
class GoogleWorkspaceAdminCustomersChromePrintServersGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_customers_chrome_print_servers_get';
    protected const DESCRIPTION = 'Customers Chrome Print Servers Get

Official Workspace Admin endpoint: GET /admin/directory/v1/{+name}
Returns a print server\'s configuration.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}