<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Remove a set of roles from the role's composite.
 *
 * Maps to DELETE /admin/realms/{realm}/roles-by-id/{role-id}/composites in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmRolesByIdRoleIdComposites extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_roles_by_id_role_id_composites',
  'class' => 'KeycloakDeleteAdminRealmsRealmRolesByIdRoleIdComposites',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/roles-by-id/{role-id}/composites',
  'summary' => 'Remove a set of roles from the role\'s composite',
  'description' => 'Remove a set of roles from the role\'s composite.',
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
      'description' => 'Role id',
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
    'role-id' => 'role_id',
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
