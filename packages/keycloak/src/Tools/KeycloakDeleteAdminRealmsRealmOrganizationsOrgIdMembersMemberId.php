<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Removes the user with the specified id from the organization.
 *
 * Maps to DELETE /admin/realms/{realm}/organizations/{org-id}/members/{member-id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdMembersMemberId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_organizations_org_id_members_member_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdMembersMemberId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/members/{member-id}',
  'summary' => 'Removes the user with the specified id from the organization',
  'description' => 'Breaks the association between the user and organization. The user itself is deleted in case the membership is managed, otherwise the user is not deleted. If no user is found, or if they are not a member of the organization, an error response is returned',
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
  'type' => 'write',
);
}
