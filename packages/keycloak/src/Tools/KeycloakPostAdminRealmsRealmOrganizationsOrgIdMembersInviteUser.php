<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Invites an existing user or sends a registration link to a new user, based on the provided e-mail address.
 *
 * Maps to POST /admin/realms/{realm}/organizations/{org-id}/members/invite-user in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmOrganizationsOrgIdMembersInviteUser extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_members_invite_user',
  'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdMembersInviteUser',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/members/invite-user',
  'summary' => 'Invites an existing user or sends a registration link to a new user, based on the provided e-mail address',
  'description' => 'If the user with the given e-mail address exists, it sends an invitation link, otherwise it sends a registration link.',
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
