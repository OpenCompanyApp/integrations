<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get all scope mappings for the client.
 *
 * Maps to GET /admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappings extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings',
  'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappings',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings',
  'summary' => 'Get all scope mappings for the client',
  'description' => 'Get all scope mappings for the client.',
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
  'content_type' => NULL,
  'type' => 'read',
);
}
