<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get representation of the client scope.
 *
 * Maps to GET /admin/realms/{realm}/client-templates/{client-scope-id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientTemplatesClientScopeId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_client_templates_client_scope_id',
  'class' => 'KeycloakGetAdminRealmsRealmClientTemplatesClientScopeId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}',
  'summary' => 'Get representation of the client scope',
  'description' => 'Get representation of the client scope.',
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
