<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Domain Aliases Delete.
 *
 * Maps to the official Workspace Admin endpoint DELETE /admin/directory/v1/customer/{customer}/domainaliases/{domainAliasName}.
 */
class GoogleWorkspaceAdminDomainAliasesDelete extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_domain_aliases_delete';
    protected const DESCRIPTION = 'Domain Aliases Delete

Official Workspace Admin endpoint: DELETE /admin/directory/v1/customer/{customer}/domainaliases/{domainAliasName}
Deletes a domain Alias of the customer.';
    protected const PARAMETERS = array (
  'customer' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customer`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'domainAliasName' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `domainAliasName`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/admin/directory/v1/customer/{customer}/domainaliases/{domainAliasName}';
    protected const PATH_PARAMS = array (
  0 => 'customer',
  1 => 'domainAliasName',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}