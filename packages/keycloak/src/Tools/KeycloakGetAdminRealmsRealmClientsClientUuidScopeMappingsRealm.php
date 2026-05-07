<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get realm-level roles associated with the client's scope.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/scope-mappings/realm in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsRealm extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_realm',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsRealm',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/realm',
  'summary' => 'Get realm-level roles associated with the client\'s scope',
  'description' => 'Get realm-level roles associated with the client\'s scope.',
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
