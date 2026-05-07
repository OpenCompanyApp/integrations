<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/users/{user-id}/groups.
 *
 * Maps to GET /admin/realms/{realm}/users/{user-id}/groups in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersUserIdGroups extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_user_id_groups',
  'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdGroups',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/{user-id}/groups',
  'summary' => 'GET /admin/realms/{realm}/users/{user-id}/groups',
  'description' => 'GET /admin/realms/{realm}/users/{user-id}/groups.',
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
      'description' => 'Official Keycloak query parameter `briefRepresentation`.',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Official Keycloak query parameter `first`.',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Official Keycloak query parameter `max`.',
    ),
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `search`.',
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
    'first' => 'first',
    'max' => 'max',
    'search' => 'search',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
