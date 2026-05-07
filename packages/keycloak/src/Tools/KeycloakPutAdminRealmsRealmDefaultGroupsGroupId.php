<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * PUT /admin/realms/{realm}/default-groups/{groupId}.
 *
 * Maps to PUT /admin/realms/{realm}/default-groups/{groupId} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmDefaultGroupsGroupId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_default_groups_group_id',
  'class' => 'KeycloakPutAdminRealmsRealmDefaultGroupsGroupId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/default-groups/{groupId}',
  'summary' => 'PUT /admin/realms/{realm}/default-groups/{groupId}',
  'description' => 'PUT /admin/realms/{realm}/default-groups/{groupId}.',
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
