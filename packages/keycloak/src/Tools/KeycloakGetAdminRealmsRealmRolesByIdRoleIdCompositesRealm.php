<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get realm-level roles that are in the role's composite.
 *
 * Maps to GET /admin/realms/{realm}/roles-by-id/{role-id}/composites/realm in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmRolesByIdRoleIdCompositesRealm extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_roles_by_id_role_id_composites_realm',
  'class' => 'KeycloakGetAdminRealmsRealmRolesByIdRoleIdCompositesRealm',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/roles-by-id/{role-id}/composites/realm',
  'summary' => 'Get realm-level roles that are in the role\'s composite',
  'description' => 'Get realm-level roles that are in the role\'s composite.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'role_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `role-id`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'role-id' => 'role_id',
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
