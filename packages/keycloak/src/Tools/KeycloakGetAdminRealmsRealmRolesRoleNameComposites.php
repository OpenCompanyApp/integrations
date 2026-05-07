<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get composites of the role.
 *
 * Maps to GET /admin/realms/{realm}/roles/{role-name}/composites in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmRolesRoleNameComposites extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_roles_role_name_composites',
  'class' => 'KeycloakGetAdminRealmsRealmRolesRoleNameComposites',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/roles/{role-name}/composites',
  'summary' => 'Get composites of the role',
  'description' => 'Get composites of the role.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'role_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'role\'s name (not id!)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'role-name' => 'role_name',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
