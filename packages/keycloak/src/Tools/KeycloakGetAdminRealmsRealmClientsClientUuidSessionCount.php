<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get application session count Returns a number of user sessions associated with this client { "count": number }.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/session-count in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidSessionCount extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_session_count',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidSessionCount',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/session-count',
  'summary' => 'Get application session count Returns a number of user sessions associated with this client { "count": number }',
  'description' => 'Get application session count Returns a number of user sessions associated with this client { "count": number }.',
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
