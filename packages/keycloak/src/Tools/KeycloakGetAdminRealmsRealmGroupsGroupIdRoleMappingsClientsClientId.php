<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get client-level role mappings for the user or group, and the app.
 *
 * Maps to GET /admin/realms/{realm}/groups/{group-id}/role-mappings/clients/{client-id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_groups_group_id_role_mappings_clients_client_id',
  'class' => 'KeycloakGetAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/clients/{client-id}',
  'summary' => 'Get client-level role mappings for the user or group, and the app',
  'description' => 'Get client-level role mappings for the user or group, and the app.',
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
