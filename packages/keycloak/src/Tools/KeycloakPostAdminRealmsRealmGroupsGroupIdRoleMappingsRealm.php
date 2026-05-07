<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Add realm-level role mappings to the user.
 *
 * Maps to POST /admin/realms/{realm}/groups/{group-id}/role-mappings/realm in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmGroupsGroupIdRoleMappingsRealm extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_groups_group_id_role_mappings_realm',
  'class' => 'KeycloakPostAdminRealmsRealmGroupsGroupIdRoleMappingsRealm',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/realm',
  'summary' => 'Add realm-level role mappings to the user',
  'description' => 'Add realm-level role mappings to the user.',
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
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}
