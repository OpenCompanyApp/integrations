<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Create or move a subgroup.
 *
 * Maps to POST /admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/children in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdChildren extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_groups_group_id_children',
  'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdChildren',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/children',
  'summary' => 'Create or move a subgroup',
  'description' => 'Creates a new subgroup under this organization group. If the group representation includes an ID, moves the existing group to be a child of this group. If no ID is provided, creates a new subgroup.',
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
    'org-id' => 'org_id',
    'group-id' => 'group_id',
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
