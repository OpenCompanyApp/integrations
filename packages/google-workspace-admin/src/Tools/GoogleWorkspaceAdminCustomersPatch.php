<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Customers Patch.
 *
 * Maps to the official Workspace Admin endpoint PATCH /admin/directory/v1/customers/{customerKey}.
 */
class GoogleWorkspaceAdminCustomersPatch extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_customers_patch';
    protected const DESCRIPTION = 'Customers Patch

Official Workspace Admin endpoint: PATCH /admin/directory/v1/customers/{customerKey}
Patches a customer.';
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
    protected const METHOD = 'PATCH';
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