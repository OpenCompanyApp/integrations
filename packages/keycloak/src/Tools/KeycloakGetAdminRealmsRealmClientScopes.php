<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get client scopes belonging to the realm Returns a list of client scopes belonging to the realm.
 *
 * Maps to GET /admin/realms/{realm}/client-scopes in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientScopes extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_client_scopes',
  'class' => 'KeycloakGetAdminRealmsRealmClientScopes',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/client-scopes',
  'summary' => 'Get client scopes belonging to the realm Returns a list of client scopes belonging to the realm',
  'description' => 'Get client scopes belonging to the realm Returns a list of client scopes belonging to the realm.',
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
