<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get members of this organization group.
 *
 * Maps to GET /admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/members in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdMembers extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_groups_group_id_members',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdGroupsGroupIdMembers',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/groups/{group-id}/members',
  'summary' => 'Get members of this organization group',
  'description' => 'Returns a paginated list of organization members that belong to this group',
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
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Only return basic information (only guaranteed to return id, username, created, first and last name, email, enabled state, email verification state, federation link, and access. Note that it means that namely user attributes, required actions, and not before are not returned.)',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Pagination offset',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Maximum results size (defaults to 100)',
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
    'briefRepresentation' => 'brief_representation',
    'first' => 'first',
    'max' => 'max',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
