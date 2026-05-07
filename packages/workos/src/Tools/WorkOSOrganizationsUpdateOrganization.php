<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Update an Organization.
 *
 * Maps to the official WorkOS endpoint put /organizations/{id}.
 */
class WorkOSOrganizationsUpdateOrganization extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organizations_update_organization';
    protected const DESCRIPTION = 'Update an Organization

Official WorkOS endpoint: PUT /organizations/{id}

Updates an organization in the current environment.';
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
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/organizations/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
