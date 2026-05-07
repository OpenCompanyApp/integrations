<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Invites an existing user to the organization, using the specified user id.
 *
 * Maps to POST /admin/realms/{realm}/organizations/{org-id}/members/invite-existing-user in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmOrganizationsOrgIdMembersInviteExistingUser extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_members_invite_existing_user',
  'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdMembersInviteExistingUser',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/members/invite-existing-user',
  'summary' => 'Invites an existing user to the organization, using the specified user id',
  'description' => 'Invites an existing user to the organization, using the specified user id.',
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
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/x-www-form-urlencoded',
  'type' => 'write',
);
}
