<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get user sessions for client Returns a list of user sessions associated with this client.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/user-sessions in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidUserSessions extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_user_sessions',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidUserSessions',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/user-sessions',
  'summary' => 'Get user sessions for client Returns a list of user sessions associated with this client',
  'description' => 'Get user sessions for client Returns a list of user sessions associated with this client.',
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
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Paging offset',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Maximum results size (defaults to 100)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
  ),
  'query_params' =>
  array (
    'first' => 'first',
    'max' => 'max',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
