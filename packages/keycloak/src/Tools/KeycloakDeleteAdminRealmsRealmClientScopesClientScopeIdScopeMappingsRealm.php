<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Remove a set of realm-level roles from the client's scope.
 *
 * Maps to DELETE /admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/realm in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealm extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm',
  'class' => 'KeycloakDeleteAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealm',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/realm',
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
    'client_scope_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `client-scope-id`.',
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
    'client-scope-id' => 'client_scope_id',
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
