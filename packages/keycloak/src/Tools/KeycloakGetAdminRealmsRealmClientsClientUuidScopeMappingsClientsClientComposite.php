<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get effective client roles Returns the roles for the client that are associated with the client's scope.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/scope-mappings/clients/{client}/composite in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsClientsClientComposite extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client_composite',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappingsClientsClientComposite',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/clients/{client}/composite',
  'summary' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope',
  'description' => 'Get effective client roles Returns the roles for the client that are associated with the client\'s scope.',
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
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'if false, return roles with their attributes',
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
    'briefRepresentation' => 'brief_representation',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
