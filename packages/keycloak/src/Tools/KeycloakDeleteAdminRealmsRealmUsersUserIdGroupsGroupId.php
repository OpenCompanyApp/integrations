<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * DELETE /admin/realms/{realm}/users/{user-id}/groups/{groupId}.
 *
 * Maps to DELETE /admin/realms/{realm}/users/{user-id}/groups/{groupId} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmUsersUserIdGroupsGroupId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_users_user_id_groups_group_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserIdGroupsGroupId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/users/{user-id}/groups/{groupId}',
  'summary' => 'DELETE /admin/realms/{realm}/users/{user-id}/groups/{groupId}',
  'description' => 'DELETE /admin/realms/{realm}/users/{user-id}/groups/{groupId}.',
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
    'group_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `groupId`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'user-id' => 'user_id',
    'groupId' => 'group_id',
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
