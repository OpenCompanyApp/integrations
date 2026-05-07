<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/group-by-path/{path}.
 *
 * Maps to GET /admin/realms/{realm}/group-by-path/{path} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmGroupByPathPath extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_group_by_path_path',
  'class' => 'KeycloakGetAdminRealmsRealmGroupByPathPath',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/group-by-path/{path}',
  'summary' => 'GET /admin/realms/{realm}/group-by-path/{path}',
  'description' => 'GET /admin/realms/{realm}/group-by-path/{path}.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'path' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `path`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'path' => 'path',
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
