<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get effective client roles Returns the roles for the client that are associated with the client's scope.
 *
 * Maps to GET /admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/clients/{client}/composite in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsClientsClientComposite extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_clients_client_composite',
  'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsClientsClientComposite',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/clients/{client}/composite',
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
    'client_scope_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `client-scope-id`.',
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
    'client-scope-id' => 'client_scope_id',
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
