<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Customers Get.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customers/{customerKey}.
 */
class GoogleWorkspaceAdminCustomersGet extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_customers_get';
    protected const DESCRIPTION = 'Customers Get

Official Workspace Admin endpoint: GET /admin/directory/v1/customers/{customerKey}
Retrieves a customer.';
    protected const PARAMETERS = array (
  'customerKey' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customerKey`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customers/{customerKey}';
    protected const PATH_PARAMS = array (
  0 => 'customerKey',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}