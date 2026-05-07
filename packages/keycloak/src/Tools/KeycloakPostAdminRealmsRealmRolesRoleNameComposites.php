<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Add a composite to the role.
 *
 * Maps to POST /admin/realms/{realm}/roles/{role-name}/composites in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmRolesRoleNameComposites extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_roles_role_name_composites',
  'class' => 'KeycloakPostAdminRealmsRealmRolesRoleNameComposites',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/roles/{role-name}/composites',
  'summary' => 'Add a composite to the role',
  'description' => 'Add a composite to the role.',
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
