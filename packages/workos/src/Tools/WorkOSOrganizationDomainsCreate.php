<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create an Organization Domain.
 *
 * Maps to the official WorkOS endpoint post /organization_domains.
 */
class WorkOSOrganizationDomainsCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organization_domains_create';
    protected const DESCRIPTION = 'Create an Organization Domain

Official WorkOS endpoint: POST /organization_domains

Creates a new Organization Domain.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/organization_domains';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
