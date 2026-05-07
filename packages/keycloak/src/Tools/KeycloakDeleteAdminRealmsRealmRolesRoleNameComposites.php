<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Remove roles from the role's composite.
 *
 * Maps to DELETE /admin/realms/{realm}/roles/{role-name}/composites in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmRolesRoleNameComposites extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_roles_role_name_composites',
  'class' => 'KeycloakDeleteAdminRealmsRealmRolesRoleNameComposites',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/roles/{role-name}/composites',
  'summary' => 'Remove roles from the role\'s composite',
  'description' => 'Remove roles from the role\'s composite.',
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
