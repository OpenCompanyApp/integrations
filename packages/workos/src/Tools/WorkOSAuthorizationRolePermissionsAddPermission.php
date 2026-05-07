<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Add a permission to an environment role.
 *
 * Maps to the official WorkOS endpoint post /authorization/roles/{slug}/permissions.
 */
class WorkOSAuthorizationRolePermissionsAddPermission extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_role_permissions_add_permission';
    protected const DESCRIPTION = 'Add a permission to an environment role

Official WorkOS endpoint: POST /authorization/roles/{slug}/permissions

Add a single permission to an environment role. If the permission is already assigned to the role, this operation has no effect.';
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
    protected const METHOD = 'post';
    protected const PATH = '/authorization/roles/{slug}/permissions';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
