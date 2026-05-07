<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get status of a username in brute force detection.
 *
 * Maps to GET /admin/realms/{realm}/attack-detection/brute-force/users/{userId} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAttackDetectionBruteForceUsersUserId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_attack_detection_brute_force_users_user_id',
  'class' => 'KeycloakGetAdminRealmsRealmAttackDetectionBruteForceUsersUserId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/attack-detection/brute-force/users/{userId}',
  'summary' => 'Get status of a username in brute force detection',
  'description' => 'Get status of a username in brute force detection.',
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
  'type' => 'read',
);
}
