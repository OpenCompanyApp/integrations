<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Returns the organization group memberships for a member with the specified id.
 *
 * Maps to GET /admin/realms/{realm}/organizations/{org-id}/members/{member-id}/groups in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersMemberIdGroups extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_members_member_id_groups',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersMemberIdGroups',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/members/{member-id}/groups',
  'summary' => 'Returns the organization group memberships for a member with the specified id',
  'description' => 'Searches for auser with the given id. If one is found, and is currently a member of the organization, returns the groups from the organizationwhere the user is member of. Otherwise, an error response with status NOT_FOUND is returned',
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
    'member_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `member-id`.',
    ),
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `briefRepresentation`.',
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
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `search`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'org-id' => 'org_id',
    'member-id' => 'member_id',
  ),
  'query_params' =>
  array (
    'briefRepresentation' => 'brief_representation',
    'first' => 'first',
    'max' => 'max',
    'search' => 'search',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
