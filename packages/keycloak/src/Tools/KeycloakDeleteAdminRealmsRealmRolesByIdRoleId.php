<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete the role.
 *
 * Maps to DELETE /admin/realms/{realm}/roles-by-id/{role-id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmRolesByIdRoleId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_roles_by_id_role_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmRolesByIdRoleId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/roles-by-id/{role-id}',
  'summary' => 'Delete the role',
  'description' => 'Delete the role.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'role_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'id of role',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'role-id' => 'role_id',
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
