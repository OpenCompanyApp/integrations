<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update the client scope.
 *
 * Maps to PUT /admin/realms/{realm}/client-templates/{client-scope-id} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmClientTemplatesClientScopeId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_client_templates_client_scope_id',
  'class' => 'KeycloakPutAdminRealmsRealmClientTemplatesClientScopeId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}',
  'summary' => 'Update the client scope',
  'description' => 'Update the client scope.',
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
