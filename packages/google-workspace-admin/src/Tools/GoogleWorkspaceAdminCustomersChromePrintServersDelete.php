<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Customers Chrome Print Servers Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/{+name}.
 */
class GoogleWorkspaceAdminCustomersChromePrintServersDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_customers_chrome_print_servers_delete';
    protected const DESCRIPTION = 'Customers Chrome Print Servers Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/{+name}
Deletes a print server.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'DELETE';
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