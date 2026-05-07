<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get group hierarchy. Only `name` and `id` are returned. `subGroups` are only returned when using the `search` or `q` parameter. If none of these parameters is provided, the top-level groups are returned without `subGroups` being filled.
 *
 * Maps to GET /admin/realms/{realm}/groups in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmGroups extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_groups',
  'class' => 'KeycloakGetAdminRealmsRealmGroups',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/groups',
  'summary' => 'Get group hierarchy. Only `name` and `id` are returned. `subGroups` are only returned when using the `search` or `q` parameter. If none of these parameters is provided, the top-level groups are returned without `subGroups` being filled',
  'description' => 'Get group hierarchy. Only `name` and `id` are returned. `subGroups` are only returned when using the `search` or `q` parameter. If none of these parameters is provided, the top-level groups are returned without `subGroups` being filled.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `briefRepresentation`.',
    ),
    'exact' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `exact`.',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Official Keycloak query parameter `first`.',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Official Keycloak query parameter `max`.',
    ),
    'populate_hierarchy' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `populateHierarchy`.',
    ),
    'q' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `q`.',
    ),
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `search`.',
    ),
    'sub_groups_count' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean which defines whether to return the count of subgroups for each group (default: true',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'briefRepresentation' => 'brief_representation',
    'exact' => 'exact',
    'first' => 'first',
    'max' => 'max',
    'populateHierarchy' => 'populate_hierarchy',
    'q' => 'q',
    'search' => 'search',
    'subGroupsCount' => 'sub_groups_count',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
