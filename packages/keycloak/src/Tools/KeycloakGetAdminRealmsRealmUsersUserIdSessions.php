<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get sessions associated with the user.
 *
 * Maps to GET /admin/realms/{realm}/users/{user-id}/sessions in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersUserIdSessions extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_user_id_sessions',
  'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdSessions',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/{user-id}/sessions',
  'summary' => 'Get sessions associated with the user',
  'description' => 'Get sessions associated with the user.',
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
