<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * DELETE /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}.
 *
 * Maps to DELETE /admin/realms/{realm}/default-default-client-scopes/{clientScopeId} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmDefaultDefaultClientScopesClientScopeId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_default_default_client_scopes_client_scope_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmDefaultDefaultClientScopesClientScopeId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/default-default-client-scopes/{clientScopeId}',
  'summary' => 'DELETE /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}',
  'description' => 'DELETE /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}.',
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
      'description' => 'Official Keycloak path parameter `clientScopeId`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
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
