<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Add client-level roles to the user or group role mapping.
 *
 * Maps to POST /admin/realms/{realm}/users/{user-id}/role-mappings/clients/{client-id} in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmUsersUserIdRoleMappingsClientsClientId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_users_user_id_role_mappings_clients_client_id',
  'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdRoleMappingsClientsClientId',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/clients/{client-id}',
  'summary' => 'Add client-level roles to the user or group role mapping',
  'description' => 'Add client-level roles to the user or group role mapping.',
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
