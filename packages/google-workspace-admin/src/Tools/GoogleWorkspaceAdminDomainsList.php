<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Domains List.
 *
 * Maps to the official Workspace Admin endpoint GET /admin/directory/v1/customer/{customer}/domains.
 */
class GoogleWorkspaceAdminDomainsList extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_domains_list';
    protected const DESCRIPTION = 'Domains List

Official Workspace Admin endpoint: GET /admin/directory/v1/customer/{customer}/domains
Lists the domains of the customer.';
    protected const PARAMETERS = array (
  'customer' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customer`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/admin/directory/v1/customer/{customer}/domains';
    protected const PATH_PARAMS = array (
  0 => 'customer',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}