<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Verify an Organization Domain.
 *
 * Maps to the official WorkOS endpoint post /organization_domains/{id}/verify.
 */
class WorkOSOrganizationDomainsVerify extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organization_domains_verify';
    protected const DESCRIPTION = 'Verify an Organization Domain

Official WorkOS endpoint: POST /organization_domains/{id}/verify

Initiates verification process for an Organization Domain.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/organization_domains/{id}/verify';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
