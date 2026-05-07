<?php

namespace OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools;

/**
 * Domain Aliases Insert.
 *
 * Maps to the official Workspace Admin endpoint POST /admin/directory/v1/customer/{customer}/domainaliases.
 */
class GoogleWorkspaceAdminDomainAliasesInsert extends AbstractGoogleWorkspaceAdminTool
{
    protected const NAME = 'google_workspace_admin_domain_aliases_insert';
    protected const DESCRIPTION = 'Domain Aliases Insert

Official Workspace Admin endpoint: POST /admin/directory/v1/customer/{customer}/domainaliases
Inserts a domain alias of the customer.';
    protected const PARAMETERS = array (
  'customer' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `customer`. Accepts the Workspace Admin identifier used by the official Directory API, such as an email address, immutable ID, customer ID, or resource key.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Workspace Admin `DomainAlias` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/admin/directory/v1/customer/{customer}/domainaliases';
    protected const PATH_PARAMS = array (
  0 => 'customer',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}