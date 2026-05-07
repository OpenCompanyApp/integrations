<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Add a user to this organization group.
 *
 * Maps to PUT /admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/members/{userId} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdMembersUserId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_organizations_org_id_groups_group_id_members_user_id',
  'class' => 'KeycloakPutAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdMembersUserId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/members/{userId}',
  'summary' => 'Add a user to this organization group',
  'description' => 'Adds an organization member to this group. The user must be a member of the organization.',
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
