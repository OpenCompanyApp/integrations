<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get organization group by path.
 *
 * Maps to GET /admin/realms/{realm}/organizations/{org-id}/groups/group-by-path/{path} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupByPathPath extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_by_path_path',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupByPathPath',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/group-by-path/{path}',
  'summary' => 'Get organization group by path',
  'description' => 'Returns the organization group with the specified path',
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
    'path' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `path`.',
    ),
    'sub_groups_count' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Whether to return the count of subgroups (default: false)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'org-id' => 'org_id',
    'path' => 'path',
  ),
  'query_params' =>
  array (
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
