<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get mappers by name for a specific protocol.
 *
 * Maps to GET /admin/realms/{realm}/client-scopes/{client-scope-id}/protocol-mappers/protocol/{protocol} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientScopesClientScopeIdProtocolMappersProtocolProtocol extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_client_scopes_client_scope_id_protocol_mappers_protocol_protocol',
  'class' => 'KeycloakGetAdminRealmsRealmClientScopesClientScopeIdProtocolMappersProtocolProtocol',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/client-scopes/{client-scope-id}/protocol-mappers/protocol/{protocol}',
  'summary' => 'Get mappers by name for a specific protocol',
  'description' => 'Get mappers by name for a specific protocol.',
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
    'protocol' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `protocol`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-scope-id' => 'client_scope_id',
    'protocol' => 'protocol',
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
