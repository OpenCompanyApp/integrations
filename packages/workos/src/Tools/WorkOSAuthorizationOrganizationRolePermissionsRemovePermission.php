<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Remove a permission from a custom role.
 *
 * Maps to the official WorkOS endpoint delete /authorization/organizations/{organizationId}/roles/{slug}/permissions/{permissionSlug}.
 */
class WorkOSAuthorizationOrganizationRolePermissionsRemovePermission extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_organization_role_permissions_remove_permission';
    protected const DESCRIPTION = 'Remove a permission from a custom role

Official WorkOS endpoint: DELETE /authorization/organizations/{organizationId}/roles/{slug}/permissions/{permissionSlug}

Remove a single permission from a custom role by its slug.';
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
  'permission_slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `permissionSlug` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/authorization/organizations/{organizationId}/roles/{slug}/permissions/{permissionSlug}';
    protected const PATH_PARAMS = array (
  'organizationId' => 'organization_id',
  'slug' => 'slug',
  'permissionSlug' => 'permission_slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
