<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get the client secret.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/client-secret in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidClientSecret extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_client_secret',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidClientSecret',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/client-secret',
  'summary' => 'Get the client secret',
  'description' => 'Get the client secret.',
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
