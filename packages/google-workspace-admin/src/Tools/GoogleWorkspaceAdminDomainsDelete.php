<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Domains Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/customer/{customer}/domains/{domainName}.
 */
class GoogleWorkspaceAdminDomainsDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_domains_delete';
    protected const DESCRIPTION = 'Domains Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/customer/{customer}/domains/{domainName}
Deletes a domain of the customer.';
    protected const PARAMETERS = array (
  'customer' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customer`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'domainName' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `domainName`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/admin/directory/v1/customer/{customer}/domains/{domainName}';
    protected const PATH_PARAMS = array (
  0 => 'customer',
  1 => 'domainName',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}