<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get application offline session count Returns a number of offline user sessions associated with this client { "count": number }.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/offline-session-count in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidOfflineSessionCount extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_offline_session_count',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidOfflineSessionCount',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/offline-session-count',
  'summary' => 'Get application offline session count Returns a number of offline user sessions associated with this client { "count": number }',
  'description' => 'Get application offline session count Returns a number of offline user sessions associated with this client { "count": number }.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'client_uuid' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'id of client (not client-id!)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
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
