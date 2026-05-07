<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get optional client scopes. Only name and ids are returned.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidOptionalClientScopes extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_optional_client_scopes',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidOptionalClientScopes',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/optional-client-scopes',
  'summary' => 'Get optional client scopes. Only name and ids are returned',
  'description' => 'Get optional client scopes. Only name and ids are returned.',
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
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
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
