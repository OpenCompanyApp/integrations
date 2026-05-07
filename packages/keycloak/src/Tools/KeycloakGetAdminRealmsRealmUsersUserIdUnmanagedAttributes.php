<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/users/{user-id}/unmanagedAttributes.
 *
 * Maps to GET /admin/realms/{realm}/users/{user-id}/unmanagedAttributes in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersUserIdUnmanagedAttributes extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_user_id_unmanaged_attributes',
  'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdUnmanagedAttributes',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/{user-id}/unmanagedAttributes',
  'summary' => 'GET /admin/realms/{realm}/users/{user-id}/unmanagedAttributes',
  'description' => 'GET /admin/realms/{realm}/users/{user-id}/unmanagedAttributes.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `user-id`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'user-id' => 'user_id',
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
