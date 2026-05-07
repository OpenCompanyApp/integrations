<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Clear any user login failures for all users This can release temporary disabled users.
 *
 * Maps to DELETE /admin/realms/{realm}/attack-detection/brute-force/users in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmAttackDetectionBruteForceUsers extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_attack_detection_brute_force_users',
  'class' => 'KeycloakDeleteAdminRealmsRealmAttackDetectionBruteForceUsers',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/attack-detection/brute-force/users',
  'summary' => 'Clear any user login failures for all users This can release temporary disabled users',
  'description' => 'Clear any user login failures for all users This can release temporary disabled users.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
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
