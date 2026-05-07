<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Remove a user from this organization group.
 *
 * Maps to DELETE /admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/members/{userId} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdMembersUserId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_organizations_org_id_groups_group_id_members_user_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdMembersUserId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/members/{userId}',
  'summary' => 'Remove a user from this organization group',
  'description' => 'Removes a user from this organization group. The user remains a member of the organization.',
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
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `userId`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'org-id' => 'org_id',
    'group-id' => 'group_id',
    'userId' => 'user_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
