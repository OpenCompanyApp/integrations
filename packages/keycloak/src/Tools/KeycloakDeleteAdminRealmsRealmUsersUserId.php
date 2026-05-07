<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete the user.
 *
 * Maps to DELETE /admin/realms/{realm}/users/{user-id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmUsersUserId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_users_user_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/users/{user-id}',
  'summary' => 'Delete the user',
  'description' => 'Delete the user.',
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
  'type' => 'write',
);
}
