<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * PUT /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}.
 *
 * Maps to PUT /admin/realms/{realm}/default-default-client-scopes/{clientScopeId} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmDefaultDefaultClientScopesClientScopeId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_default_default_client_scopes_client_scope_id',
  'class' => 'KeycloakPutAdminRealmsRealmDefaultDefaultClientScopesClientScopeId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/default-default-client-scopes/{clientScopeId}',
  'summary' => 'PUT /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}',
  'description' => 'PUT /admin/realms/{realm}/default-default-client-scopes/{clientScopeId}.',
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
