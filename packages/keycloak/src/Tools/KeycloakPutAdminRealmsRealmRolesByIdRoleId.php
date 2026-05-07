<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update the role.
 *
 * Maps to PUT /admin/realms/{realm}/roles-by-id/{role-id} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmRolesByIdRoleId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_roles_by_id_role_id',
  'class' => 'KeycloakPutAdminRealmsRealmRolesByIdRoleId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/roles-by-id/{role-id}',
  'summary' => 'Update the role',
  'description' => 'Update the role.',
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
