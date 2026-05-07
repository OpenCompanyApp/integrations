<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get effective realm-level roles associated with the client’s scope What this does is recurse any composite roles associated with the client’s scope and adds the roles to this lists.
 *
 * Maps to GET /admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/realm/composite in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealmComposite extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_scope_mappings_realm_composite',
  'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdScopeMappingsRealmComposite',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/scope-mappings/realm/composite',
  'summary' => 'Get effective realm-level roles associated with the client’s scope What this does is recurse any composite roles associated with the client’s scope and adds the roles to this lists',
  'description' => 'The method is really to show a comprehensive total view of realm-level roles associated with the client.',
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
