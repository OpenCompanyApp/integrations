<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get an environment role.
 *
 * Maps to the official WorkOS endpoint get /authorization/roles/{slug}.
 */
class WorkOSAuthorizationRolesGet extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_roles_get';
    protected const DESCRIPTION = 'Get an environment role

Official WorkOS endpoint: GET /authorization/roles/{slug}

Get an environment role by its slug.';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `slug` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/authorization/roles/{slug}';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
