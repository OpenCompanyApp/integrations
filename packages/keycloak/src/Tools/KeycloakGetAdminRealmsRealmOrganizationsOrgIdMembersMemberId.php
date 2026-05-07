<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Returns the member of the organization with the specified id.
 *
 * Maps to GET /admin/realms/{realm}/organizations/{org-id}/members/{member-id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersMemberId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_members_member_id',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersMemberId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/members/{member-id}',
  'summary' => 'Returns the member of the organization with the specified id',
  'description' => 'Searches for auser with the given id. If one is found, and is currently a member of the organization, returns it. Otherwise,an error response with status NOT_FOUND is returned',
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
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'org-id' => 'org_id',
    'member-id' => 'member_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
