<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get a role by name.
 *
 * Maps to GET /admin/realms/{realm}/roles/{role-name} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmRolesRoleName extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_roles_role_name',
  'class' => 'KeycloakGetAdminRealmsRealmRolesRoleName',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/roles/{role-name}',
  'summary' => 'Get a role by name',
  'description' => 'Get a role by name.',
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
