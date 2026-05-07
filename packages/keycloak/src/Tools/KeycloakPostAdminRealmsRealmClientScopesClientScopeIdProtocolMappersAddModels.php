<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Create multiple mappers.
 *
 * Maps to POST /admin/realms/{realm}/client-scopes/{client-scope-id}/protocol-mappers/add-models in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientScopesClientScopeIdProtocolMappersAddModels extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_add_models',
  'class' => 'KeycloakPostAdminRealmsRealmClientScopesClientScopeIdProtocolMappersAddModels',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/protocol-mappers/add-models',
  'summary' => 'Create multiple mappers',
  'description' => 'Create multiple mappers.',
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
