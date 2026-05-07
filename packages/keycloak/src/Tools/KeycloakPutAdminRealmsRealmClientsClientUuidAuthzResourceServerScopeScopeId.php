<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}.
 *
 * Maps to PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid_authz_resource_server_scope_scope_id',
  'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuidAuthzResourceServerScopeScopeId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}',
  'summary' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}',
  'description' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope/{scope-id}.',
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}
