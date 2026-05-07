<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get effective realm-level role mappings This will recurse all composite roles to get the result.
 *
 * Maps to GET /admin/realms/{realm}/users/{user-id}/role-mappings/realm/composite in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsRealmComposite extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_user_id_role_mappings_realm_composite',
  'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdRoleMappingsRealmComposite',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/{user-id}/role-mappings/realm/composite',
  'summary' => 'Get effective realm-level role mappings This will recurse all composite roles to get the result',
  'description' => 'Get effective realm-level role mappings This will recurse all composite roles to get the result.',
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
