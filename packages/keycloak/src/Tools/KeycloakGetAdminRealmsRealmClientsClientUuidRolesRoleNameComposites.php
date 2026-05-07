<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get composites of the role.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/composites in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameComposites extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_composites',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameComposites',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/composites',
  'summary' => 'Get composites of the role',
  'description' => 'Get composites of the role.',
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
