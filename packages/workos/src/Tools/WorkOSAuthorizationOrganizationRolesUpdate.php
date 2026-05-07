<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Update a custom role.
 *
 * Maps to the official WorkOS endpoint patch /authorization/organizations/{organizationId}/roles/{slug}.
 */
class WorkOSAuthorizationOrganizationRolesUpdate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_organization_roles_update';
    protected const DESCRIPTION = 'Update a custom role

Official WorkOS endpoint: PATCH /authorization/organizations/{organizationId}/roles/{slug}

Update an existing custom role. Only the fields provided in the request body will be updated.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/authorization/organizations/{organizationId}/roles/{slug}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
