<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Update an environment role.
 *
 * Maps to the official WorkOS endpoint patch /authorization/roles/{slug}.
 */
class WorkOSAuthorizationRolesUpdate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_roles_update';
    protected const DESCRIPTION = 'Update an environment role

Official WorkOS endpoint: PATCH /authorization/roles/{slug}

Update an existing environment role.';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `slug` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/authorization/roles/{slug}';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
