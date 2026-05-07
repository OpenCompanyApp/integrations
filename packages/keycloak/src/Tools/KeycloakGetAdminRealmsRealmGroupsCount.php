<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Returns the groups counts.
 *
 * Maps to GET /admin/realms/{realm}/groups/count in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmGroupsCount extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_groups_count',
  'class' => 'KeycloakGetAdminRealmsRealmGroupsCount',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/groups/count',
  'summary' => 'Returns the groups counts',
  'description' => 'Returns the groups counts.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `search`.',
    ),
    'top' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `top`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'search' => 'search',
    'top' => 'top',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
