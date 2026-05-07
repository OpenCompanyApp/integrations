<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get an Organization Domain.
 *
 * Maps to the official WorkOS endpoint get /organization_domains/{id}.
 */
class WorkOSOrganizationDomainsGet extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organization_domains_get';
    protected const DESCRIPTION = 'Get an Organization Domain

Official WorkOS endpoint: GET /organization_domains/{id}

Get the details of an existing organization domain.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/organization_domains/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
