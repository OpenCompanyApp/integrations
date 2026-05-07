<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get subgroups of this organization group.
 *
 * Maps to GET /admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/children in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdChildren extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_id_children',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdChildren',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/children',
  'summary' => 'Get subgroups of this organization group',
  'description' => 'Returns a paginated stream of subgroups that belong to this organization group',
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
    'exact' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean which defines whether the params "search" must match exactly or not',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'The position of the first result to be returned (pagination offset).',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'The maximum number of results that are to be returned. Defaults to 10',
    ),
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A String representing either an exact group name or a partial name',
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
    'exact' => 'exact',
    'first' => 'first',
    'max' => 'max',
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
