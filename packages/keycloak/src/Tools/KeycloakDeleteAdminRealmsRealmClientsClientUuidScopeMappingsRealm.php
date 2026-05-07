<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Remove a set of realm-level roles from the client's scope.
 *
 * Maps to DELETE /admin/realms/{realm}/clients/{client-uuid}/scope-mappings/realm in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmClientsClientUuidScopeMappingsRealm extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_scope_mappings_realm',
  'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidScopeMappingsRealm',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/realm',
  'summary' => 'Remove a set of realm-level roles from the client\'s scope',
  'description' => 'Remove a set of realm-level roles from the client\'s scope.',
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
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}
