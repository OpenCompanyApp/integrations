<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Customers Chrome Printers Create.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/{+parent}/chrome/printers.
 */
class GoogleWorkspaceAdminCustomersChromePrintersCreate extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_customers_chrome_printers_create';
    protected const DESCRIPTION = 'Customers Chrome Printers Create

Official Workspace Admin endpoint: POST /admin/directory/v1/{+parent}/chrome/printers
Creates a printer under given Organization Unit.';
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
    'description' => 'JSON request body matching the official Workspace Admin `Printer` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/{+parent}/chrome/printers';
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