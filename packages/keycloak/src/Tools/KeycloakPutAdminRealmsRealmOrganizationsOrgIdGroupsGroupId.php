<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update organization group.
 *
 * Maps to PUT /admin/realms/{realm}/organizations/{org-id}/groups/{group-id} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmOrganizationsOrgIdGroupsGroupId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_organizations_org_id_groups_group_id',
  'class' => 'KeycloakPutAdminRealmsRealmOrganizationsOrgIdGroupsGroupId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}',
  'summary' => 'Update organization group',
  'description' => 'Updates the organization group\'s name, description, and attributes. Subgroups are not affected.',
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
