<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get realm-level roles of the role's composite.
 *
 * Maps to GET /admin/realms/{realm}/roles/{role-name}/composites/realm in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmRolesRoleNameCompositesRealm extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_roles_role_name_composites_realm',
  'class' => 'KeycloakGetAdminRealmsRealmRolesRoleNameCompositesRealm',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/roles/{role-name}/composites/realm',
  'summary' => 'Get realm-level roles of the role\'s composite',
  'description' => 'Get realm-level roles of the role\'s composite.',
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
