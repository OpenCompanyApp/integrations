<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/groups/{group-id}.
 *
 * Maps to GET /admin/realms/{realm}/groups/{group-id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmGroupsGroupId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_groups_group_id',
  'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/groups/{group-id}',
  'summary' => 'GET /admin/realms/{realm}/groups/{group-id}',
  'description' => 'GET /admin/realms/{realm}/groups/{group-id}.',
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
      'description' => 'Official Keycloak path parameter `group-id`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'group-id' => 'group_id',
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
