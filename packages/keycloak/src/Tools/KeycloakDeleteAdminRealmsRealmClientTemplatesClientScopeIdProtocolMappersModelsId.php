<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete the mapper.
 *
 * Maps to DELETE /admin/realms/{realm}/client-templates/{client-scope-id}/protocol-mappers/models/{id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersModelsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_client_templates_client_scope_id_protocol_mappers_models_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmClientTemplatesClientScopeIdProtocolMappersModelsId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/protocol-mappers/models/{id}',
  'summary' => 'Delete the mapper',
  'description' => 'Delete the mapper.',
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
  'type' => 'write',
);
}
