<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get representation of the user.
 *
 * Maps to GET /admin/realms/{realm}/users/{user-id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersUserId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_user_id',
  'class' => 'KeycloakGetAdminRealmsRealmUsersUserId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/{user-id}',
  'summary' => 'Get representation of the user',
  'description' => 'Get representation of the user.',
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
    'user_profile_metadata' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Indicates if the user profile metadata should be added to the response',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'user-id' => 'user_id',
  ),
  'query_params' =>
  array (
    'userProfileMetadata' => 'user_profile_metadata',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
