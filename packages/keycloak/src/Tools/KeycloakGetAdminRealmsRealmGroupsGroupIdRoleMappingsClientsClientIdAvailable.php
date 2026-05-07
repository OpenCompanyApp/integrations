<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get available client-level roles that can be mapped to the user or group.
 *
 * Maps to GET /admin/realms/{realm}/groups/{group-id}/role-mappings/clients/{client-id}/available in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientIdAvailable extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_clients_client_id_available',
  'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientIdAvailable',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/clients/{client-id}/available',
  'summary' => 'Get available client-level roles that can be mapped to the user or group',
  'description' => 'Get available client-level roles that can be mapped to the user or group.',
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
    'client_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'client id (not clientId!)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'group-id' => 'group_id',
    'client-id' => 'client_id',
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
