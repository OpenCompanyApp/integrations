<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get realm optional client scopes. Only name and ids are returned.
 *
 * Maps to GET /admin/realms/{realm}/default-optional-client-scopes in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmDefaultOptionalClientScopes extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_default_optional_client_scopes',
  'class' => 'KeycloakGetAdminRealmsRealmDefaultOptionalClientScopes',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/default-optional-client-scopes',
  'summary' => 'Get realm optional client scopes. Only name and ids are returned',
  'description' => 'Get realm optional client scopes. Only name and ids are returned.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
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
