<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * DELETE /admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}.
 *
 * Maps to DELETE /admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmClientsClientUuidOptionalClientScopesClientScopeId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_optional_client_scopes_client_scope_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidOptionalClientScopesClientScopeId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}',
  'summary' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}',
  'description' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes/{clientScopeId}.',
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
    'client_scope_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `clientScopeId`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
    'clientScopeId' => 'client_scope_id',
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
