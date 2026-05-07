<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * DELETE /admin/realms/{realm}/default-groups/{groupId}.
 *
 * Maps to DELETE /admin/realms/{realm}/default-groups/{groupId} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmDefaultGroupsGroupId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_default_groups_group_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmDefaultGroupsGroupId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/default-groups/{groupId}',
  'summary' => 'DELETE /admin/realms/{realm}/default-groups/{groupId}',
  'description' => 'DELETE /admin/realms/{realm}/default-groups/{groupId}.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
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
