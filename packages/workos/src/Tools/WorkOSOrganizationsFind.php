<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get an Organization.
 *
 * Maps to the official WorkOS endpoint get /organizations/{id}.
 */
class WorkOSOrganizationsFind extends AbstractWorkOSTool
{
    protected const NAME = 'workos_organizations_find';
    protected const DESCRIPTION = 'Get an Organization

Official WorkOS endpoint: GET /organizations/{id}

Get the details of an existing organization.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/organizations/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
