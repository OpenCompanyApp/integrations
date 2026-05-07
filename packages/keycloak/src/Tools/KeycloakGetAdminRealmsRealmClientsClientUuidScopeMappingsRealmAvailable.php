<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get realm-level roles that are available to attach to this client's scope.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/scope-mappings/realm/available in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsRealmAvailable extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_realm_available',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsRealmAvailable',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/realm/available',
  'summary' => 'Get realm-level roles that are available to attach to this client\'s scope',
  'description' => 'Get realm-level roles that are available to attach to this client\'s scope.',
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
