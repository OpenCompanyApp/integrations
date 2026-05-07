<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get mapper by id.
 *
 * Maps to GET /admin/realms/{realm}/client-scopes/{client-scope-id}/protocol-mappers/models/{id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientScopesClientScopeIdProtocolMappersModelsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_models_id',
  'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdProtocolMappersModelsId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/protocol-mappers/models/{id}',
  'summary' => 'Get mapper by id',
  'description' => 'Get mapper by id.',
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
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Mapper id',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-scope-id' => 'client_scope_id',
    'id' => 'id',
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
