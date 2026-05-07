<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/users/{user-id}/groups/count.
 *
 * Maps to GET /admin/realms/{realm}/users/{user-id}/groups/count in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersUserIdGroupsCount extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_user_id_groups_count',
  'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdGroupsCount',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/{user-id}/groups/count',
  'summary' => 'GET /admin/realms/{realm}/users/{user-id}/groups/count',
  'description' => 'GET /admin/realms/{realm}/users/{user-id}/groups/count.',
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
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `search`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'user-id' => 'user_id',
  ),
  'query_params' =>
  array (
    'search' => 'search',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
