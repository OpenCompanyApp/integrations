<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Add realm-level role mappings to the user.
 *
 * Maps to POST /admin/realms/{realm}/users/{user-id}/role-mappings/realm in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmUsersUserIdRoleMappingsRealm extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_users_user_id_role_mappings_realm',
  'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdRoleMappingsRealm',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/realm',
  'summary' => 'Add realm-level role mappings to the user',
  'description' => 'Add realm-level role mappings to the user.',
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
