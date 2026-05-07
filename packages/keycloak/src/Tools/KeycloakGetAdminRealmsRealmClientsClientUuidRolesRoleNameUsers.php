<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Returns a stream of users that have the specified role name.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/users in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameUsers extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_users',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameUsers',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/users',
  'summary' => 'Returns a stream of users that have the specified role name',
  'description' => 'Returns a stream of users that have the specified role name.',
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
    'role_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'the role name.',
    ),
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean which defines whether brief representations are returned (default: false)',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'first result to return. Ignored if negative or {@code null}.',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'maximum number of results to return. Ignored if negative or {@code null}.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
    'role-name' => 'role_name',
  ),
  'query_params' =>
  array (
    'briefRepresentation' => 'brief_representation',
    'first' => 'first',
    'max' => 'max',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
