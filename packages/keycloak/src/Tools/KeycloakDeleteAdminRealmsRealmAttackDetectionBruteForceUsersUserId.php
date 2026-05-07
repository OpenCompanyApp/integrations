<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Clear any user login failures for the user This can release temporary disabled user.
 *
 * Maps to DELETE /admin/realms/{realm}/attack-detection/brute-force/users/{userId} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmAttackDetectionBruteForceUsersUserId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_attack_detection_brute_force_users_user_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmAttackDetectionBruteForceUsersUserId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/attack-detection/brute-force/users/{userId}',
  'summary' => 'Clear any user login failures for the user This can release temporary disabled user',
  'description' => 'Clear any user login failures for the user This can release temporary disabled user.',
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
      'description' => 'Official Keycloak path parameter `userId`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'userId' => 'user_id',
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
