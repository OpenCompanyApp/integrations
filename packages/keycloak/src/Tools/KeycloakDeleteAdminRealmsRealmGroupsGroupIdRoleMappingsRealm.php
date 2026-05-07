<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete realm-level role mappings.
 *
 * Maps to DELETE /admin/realms/{realm}/groups/{group-id}/role-mappings/realm in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmGroupsGroupIdRoleMappingsRealm extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_groups_group_id_role_mappings_realm',
  'class' => 'KeycloakDeleteAdminRealmsRealmGroupsGroupIdRoleMappingsRealm',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/realm',
  'summary' => 'Delete realm-level role mappings',
  'description' => 'Delete realm-level role mappings.',
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
