<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Customers Chrome Print Servers Batch Create Print Servers.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/{+parent}/chrome/printServers:batchCreatePrintServers.
 */
class GoogleWorkspaceAdminCustomersChromePrintServersBatchCreatePrintServers extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_customers_chrome_print_servers_batch_create_print_servers';
    protected const DESCRIPTION = 'Customers Chrome Print Servers Batch Create Print Servers

Official Workspace Admin endpoint: POST /admin/directory/v1/{+parent}/chrome/printServers:batchCreatePrintServers
Creates multiple print servers.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `BatchCreatePrintServersRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/{+parent}/chrome/printServers:batchCreatePrintServers';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}