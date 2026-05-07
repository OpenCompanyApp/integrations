<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete realm-level role mappings.
 *
 * Maps to DELETE /admin/realms/{realm}/users/{user-id}/role-mappings/realm in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmUsersUserIdRoleMappingsRealm extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_users_user_id_role_mappings_realm',
  'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserIdRoleMappingsRealm',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/realm',
  'summary' => 'Delete realm-level role mappings',
  'description' => 'Delete realm-level role mappings.',
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
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}
