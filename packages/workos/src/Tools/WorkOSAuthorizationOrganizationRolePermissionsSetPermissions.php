<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Set permissions for a custom role.
 *
 * Maps to the official WorkOS endpoint put /authorization/organizations/{organizationId}/roles/{slug}/permissions.
 */
class WorkOSAuthorizationOrganizationRolePermissionsSetPermissions extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_organization_role_permissions_set_permissions';
    protected const DESCRIPTION = 'Set permissions for a custom role

Official WorkOS endpoint: PUT /authorization/organizations/{organizationId}/roles/{slug}/permissions

Replace all permissions on a custom role with the provided list.';
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
    protected const METHOD = 'put';
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
