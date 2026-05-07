<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Return object stating whether role Authorization permissions have been initialized or not and a reference.
 *
 * Maps to GET /admin/realms/{realm}/roles/{role-name}/management/permissions in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmRolesRoleNameManagementPermissions extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_roles_role_name_management_permissions',
  'class' => 'KeycloakGetAdminRealmsRealmRolesRoleNameManagementPermissions',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/roles/{role-name}/management/permissions',
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
    'role_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `role-name`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
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
