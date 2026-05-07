<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get a specific role's representation.
 *
 * Maps to GET /admin/realms/{realm}/roles-by-id/{role-id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmRolesByIdRoleId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_roles_by_id_role_id',
  'class' => 'KeycloakGetAdminRealmsRealmRolesByIdRoleId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/roles-by-id/{role-id}',
  'summary' => 'Get a specific role\'s representation',
  'description' => 'Get a specific role\'s representation.',
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
      'description' => 'id of role',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'role-id' => 'role_id',
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
