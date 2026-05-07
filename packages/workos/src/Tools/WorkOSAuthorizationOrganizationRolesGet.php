<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a custom role.
 *
 * Maps to the official WorkOS endpoint get /authorization/organizations/{organizationId}/roles/{slug}.
 */
class WorkOSAuthorizationOrganizationRolesGet extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_organization_roles_get';
    protected const DESCRIPTION = 'Get a custom role

Official WorkOS endpoint: GET /authorization/organizations/{organizationId}/roles/{slug}

Retrieve a role that applies to an organization by its slug. This can return either an environment role or a custom role.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organizationId` from the official WorkOS API operation.',
  ),
  'slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `slug` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/authorization/organizations/{organizationId}/roles/{slug}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
