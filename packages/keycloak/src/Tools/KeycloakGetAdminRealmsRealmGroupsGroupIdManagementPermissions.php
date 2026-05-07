<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Return object stating whether client Authorization permissions have been initialized or not and a reference.
 *
 * Maps to GET /admin/realms/{realm}/groups/{group-id}/management/permissions in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmGroupsGroupIdManagementPermissions extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_management_permissions',
  'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdManagementPermissions',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/groups/{group-id}/management/permissions',
  'summary' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
  'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
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
