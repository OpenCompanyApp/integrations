<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get default client scopes. Only name and ids are returned.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/default-client-scopes in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidDefaultClientScopes extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_default_client_scopes',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidDefaultClientScopes',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/default-client-scopes',
  'summary' => 'Get default client scopes. Only name and ids are returned',
  'description' => 'Get default client scopes. Only name and ids are returned.',
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
