<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * The available client-level roles Returns the roles for the client that can be associated with the client's scope.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/scope-mappings/clients/{client}/available in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsClientsClientAvailable extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client_available',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsClientsClientAvailable',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/clients/{client}/available',
  'summary' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope',
  'description' => 'The available client-level roles Returns the roles for the client that can be associated with the client\'s scope.',
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
    'client' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `client`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
    'client' => 'client',
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
