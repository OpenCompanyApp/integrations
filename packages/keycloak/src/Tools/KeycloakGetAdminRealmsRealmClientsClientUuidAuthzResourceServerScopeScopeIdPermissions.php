<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/permissions.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/permissions in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeIdPermissions extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id_permissions',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeIdPermissions',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/permissions',
  'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/permissions',
  'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}/permissions.',
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
    'scope_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `scope-id`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
    'scope-id' => 'scope_id',
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
