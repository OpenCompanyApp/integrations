<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Customers Update.
 *
 * Maps to the official Workspace Admin endpoint PUT /admin/directory/v1/customers/{customerKey}.
 */
class GoogleWorkspaceAdminCustomersUpdate extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_customers_update';
    protected const DESCRIPTION = 'Customers Update

Official Workspace Admin endpoint: PUT /admin/directory/v1/customers/{customerKey}
Updates a customer.';
    protected const PARAMETERS = array (
  'customerKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customerKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `Customer` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/admin/directory/v1/customers/{customerKey}';
    protected const PATH_PARAMS = array (
  0 => 'customerKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}