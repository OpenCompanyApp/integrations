<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete the organization group.
 *
 * Maps to DELETE /admin/realms/{realm}/organizations/{org-id}/groups/{group-id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdGroupsGroupId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_organizations_org_id_groups_group_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdGroupsGroupId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}',
  'summary' => 'Delete the organization group',
  'description' => 'Deletes the organization group and all its subgroups',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
