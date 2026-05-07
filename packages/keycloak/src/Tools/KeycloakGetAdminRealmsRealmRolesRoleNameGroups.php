<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Returns a stream of groups that have the specified role name.
 *
 * Maps to GET /admin/realms/{realm}/roles/{role-name}/groups in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmRolesRoleNameGroups extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_roles_role_name_groups',
  'class' => 'KeycloakGetAdminRealmsRealmRolesRoleNameGroups',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/roles/{role-name}/groups',
  'summary' => 'Returns a stream of groups that have the specified role name',
  'description' => 'Returns a stream of groups that have the specified role name.',
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
      'description' => 'the role name.',
    ),
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'if false, return a full representation of the {@code GroupRepresentation} objects.',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'first result to return. Ignored if negative or {@code null}.',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'maximum number of results to return. Ignored if negative or {@code null}.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'role-name' => 'role_name',
  ),
  'query_params' =>
  array (
    'briefRepresentation' => 'brief_representation',
    'first' => 'first',
    'max' => 'max',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
