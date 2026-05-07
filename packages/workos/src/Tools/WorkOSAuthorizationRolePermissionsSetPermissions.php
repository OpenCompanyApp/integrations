<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Set permissions for an environment role.
 *
 * Maps to the official WorkOS endpoint put /authorization/roles/{slug}/permissions.
 */
class WorkOSAuthorizationRolePermissionsSetPermissions extends AbstractWorkOSTool
{
    protected const NAME = 'workos_authorization_role_permissions_set_permissions';
    protected const DESCRIPTION = 'Set permissions for an environment role

Official WorkOS endpoint: PUT /authorization/roles/{slug}/permissions

Replace all permissions on an environment role with the provided list.';
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
    protected const METHOD = 'put';
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
