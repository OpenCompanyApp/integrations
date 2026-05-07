<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get organization groups.
 *
 * Maps to GET /admin/realms/{realm}/organizations/{org-id}/groups in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroups extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_groups',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroups',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/groups',
  'summary' => 'Get organization groups',
  'description' => 'Returns organization groups. When `search` parameter is provided, groups are searched by name. When `q` parameter is provided, groups are searched by attributes. If neither parameter is provided, top-level groups are returned.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'org_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `org-id`.',
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
      'description' => 'Official Keycloak query parameter `subGroupsCount`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'org-id' => 'org_id',
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
