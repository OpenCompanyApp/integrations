<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/users-management-permissions.
 *
 * Maps to GET /admin/realms/{realm}/users-management-permissions in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersManagementPermissions extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_management_permissions',
  'class' => 'KeycloakGetAdminRealmsRealmUsersManagementPermissions',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users-management-permissions',
  'summary' => 'GET /admin/realms/{realm}/users-management-permissions',
  'description' => 'GET /admin/realms/{realm}/users-management-permissions.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
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
