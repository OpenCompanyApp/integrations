<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get organization group representation.
 *
 * Maps to GET /admin/realms/{realm}/organizations/{org-id}/groups/{group-id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_id',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}',
  'summary' => 'Get organization group representation',
  'description' => 'Get organization group representation.',
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
    'group_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `group-id`.',
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
    'group-id' => 'group_id',
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
