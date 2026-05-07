<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get realm-level role mappings.
 *
 * Maps to GET /admin/realms/{realm}/users/{user-id}/role-mappings/realm in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsRealm extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_user_id_role_mappings_realm',
  'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsRealm',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/realm',
  'summary' => 'Get realm-level role mappings',
  'description' => 'Get realm-level role mappings.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `user-id`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'user-id' => 'user_id',
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
