<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create a custom role.
 *
 * Maps to the official WorkOS endpoint post /authorization/organizations/{organizationId}/roles.
 */
class WorkOSAuthorizationOrganizationRolesCreate extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_organization_roles_create';
    protected const DESCRIPTION = 'Create a custom role

Official WorkOS endpoint: POST /authorization/organizations/{organizationId}/roles

Create a new custom role for this organization.';
    protected const PARAMETERS = array (
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `organizationId` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/authorization/organizations/{organizationId}/roles';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
