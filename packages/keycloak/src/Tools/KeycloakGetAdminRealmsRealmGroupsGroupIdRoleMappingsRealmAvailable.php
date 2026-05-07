<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get realm-level roles that can be mapped.
 *
 * Maps to GET /admin/realms/{realm}/groups/{group-id}/role-mappings/realm/available in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsRealmAvailable extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_realm_available',
  'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsRealmAvailable',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/realm/available',
  'summary' => 'Get realm-level roles that can be mapped',
  'description' => 'Get realm-level roles that can be mapped.',
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
