<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get a role by name.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/roles/{role-name} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleName extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleName',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}',
  'summary' => 'Get a role by name',
  'description' => 'Get a role by name.',
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
      'description' => 'role\'s name (not id!)',
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
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
