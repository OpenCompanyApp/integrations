<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * DELETE /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}.
 *
 * Maps to DELETE /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}',
  'summary' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}',
  'description' => 'DELETE /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}.',
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
  'type' => 'write',
);
}
