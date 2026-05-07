<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get all scope mappings for the client.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/scope-mappings in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappings extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_scope_mappings',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidScopeMappings',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings',
  'summary' => 'Get all scope mappings for the client',
  'description' => 'Get all scope mappings for the client.',
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
