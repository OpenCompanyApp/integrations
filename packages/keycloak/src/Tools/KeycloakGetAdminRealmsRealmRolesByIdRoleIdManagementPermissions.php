<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Return object stating whether role Authorization permissions have been initialized or not and a reference.
 *
 * Maps to GET /admin/realms/{realm}/roles-by-id/{role-id}/management/permissions in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmRolesByIdRoleIdManagementPermissions extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_roles_by_id_role_id_management_permissions',
  'class' => 'KeycloakGetAdminRealmsRealmRolesByIdRoleIdManagementPermissions',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/roles-by-id/{role-id}/management/permissions',
  'summary' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference',
  'description' => 'Return object stating whether role Authorization permissions have been initialized or not and a reference.',
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
      'description' => 'Official Keycloak path parameter `role-id`.',
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
  'type' => 'read',
);
}
