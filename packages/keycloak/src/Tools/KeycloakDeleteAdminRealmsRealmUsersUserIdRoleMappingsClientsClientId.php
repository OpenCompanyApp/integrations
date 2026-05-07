<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete client-level roles from user or group role mapping.
 *
 * Maps to DELETE /admin/realms/{realm}/users/{user-id}/role-mappings/clients/{client-id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmUsersUserIdRoleMappingsClientsClientId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_users_user_id_role_mappings_clients_client_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserIdRoleMappingsClientsClientId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/clients/{client-id}',
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
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `user-id`.',
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
    'user-id' => 'user_id',
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
