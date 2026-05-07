<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Add a permission to a custom role.
 *
 * Maps to the official WorkOS endpoint post /authorization/organizations/{organizationId}/roles/{slug}/permissions.
 */
class WorkOSAuthorizationOrganizationRolePermissionsAddPermission extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_organization_role_permissions_add_permission';
    protected const DESCRIPTION = 'Add a permission to a custom role

Official WorkOS endpoint: POST /authorization/organizations/{organizationId}/roles/{slug}/permissions

Add a single permission to a custom role. If the permission is already assigned to the role, this operation has no effect.';
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
    protected const METHOD = 'post';
    protected const PATH = '/authorization/organizations/{organizationId}/roles/{slug}/permissions';
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
