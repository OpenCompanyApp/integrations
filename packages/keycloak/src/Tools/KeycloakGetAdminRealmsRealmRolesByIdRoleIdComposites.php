<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get role's children Returns a set of role's children provided the role is a composite.
 *
 * Maps to GET /admin/realms/{realm}/roles-by-id/{role-id}/composites in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmRolesByIdRoleIdComposites extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_roles_by_id_role_id_composites',
  'class' => 'KeycloakGetAdminRealmsRealmRolesByIdRoleIdComposites',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/roles-by-id/{role-id}/composites',
  'summary' => 'Get role\'s children Returns a set of role\'s children provided the role is a composite',
  'description' => 'Get role\'s children Returns a set of role\'s children provided the role is a composite.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'role_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `role-id`.',
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
    'role-id' => 'role_id',
  ),
  'query_params' =>
  array (
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
