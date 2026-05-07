<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Make the role a composite role by associating some child roles.
 *
 * Maps to POST /admin/realms/{realm}/roles-by-id/{role-id}/composites in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmRolesByIdRoleIdComposites extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_roles_by_id_role_id_composites',
  'class' => 'KeycloakPostAdminRealmsRealmRolesByIdRoleIdComposites',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/roles-by-id/{role-id}/composites',
  'summary' => 'Make the role a composite role by associating some child roles',
  'description' => 'Make the role a composite role by associating some child roles.',
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
