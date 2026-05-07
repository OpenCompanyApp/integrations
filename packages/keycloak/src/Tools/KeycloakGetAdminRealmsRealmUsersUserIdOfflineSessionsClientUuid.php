<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get offline sessions associated with the user and client.
 *
 * Maps to GET /admin/realms/{realm}/users/{user-id}/offline-sessions/{clientUuid} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersUserIdOfflineSessionsClientUuid extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_user_id_offline_sessions_client_uuid',
  'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdOfflineSessionsClientUuid',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/{user-id}/offline-sessions/{clientUuid}',
  'summary' => 'Get offline sessions associated with the user and client',
  'description' => 'Get offline sessions associated with the user and client.',
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
    'client_uuid' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `clientUuid`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'user-id' => 'user_id',
    'clientUuid' => 'client_uuid',
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
