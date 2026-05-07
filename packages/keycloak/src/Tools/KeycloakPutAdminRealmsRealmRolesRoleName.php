<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update a role by name.
 *
 * Maps to PUT /admin/realms/{realm}/roles/{role-name} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmRolesRoleName extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_roles_role_name',
  'class' => 'KeycloakPutAdminRealmsRealmRolesRoleName',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/roles/{role-name}',
  'summary' => 'Update a role by name',
  'description' => 'Update a role by name.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'role_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'role\'s name (not id!)',
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
    'role-name' => 'role_name',
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
