<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete client-level roles from user or group role mapping.
 *
 * Maps to DELETE /admin/realms/{realm}/groups/{group-id}/role-mappings/clients/{client-id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_groups_group_id_role_mappings_clients_client_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmGroupsGroupIdRoleMappingsClientsClientId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/groups/{group-id}/role-mappings/clients/{client-id}',
  'summary' => 'Delete client-level roles from user or group role mapping',
  'description' => 'Delete client-level roles from user or group role mapping.',
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
    'client-id' => 'client_id',
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
