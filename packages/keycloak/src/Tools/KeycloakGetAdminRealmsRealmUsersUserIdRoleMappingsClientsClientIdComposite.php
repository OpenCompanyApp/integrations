<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get effective client-level role mappings This recurses any composite roles.
 *
 * Maps to GET /admin/realms/{realm}/users/{user-id}/role-mappings/clients/{client-id}/composite in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsClientsClientIdComposite extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_user_id_role_mappings_clients_client_id_composite',
  'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsClientsClientIdComposite',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/clients/{client-id}/composite',
  'summary' => 'Get effective client-level role mappings This recurses any composite roles',
  'description' => 'Get effective client-level role mappings This recurses any composite roles.',
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
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'if false, return roles with their attributes',
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
    'briefRepresentation' => 'brief_representation',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
