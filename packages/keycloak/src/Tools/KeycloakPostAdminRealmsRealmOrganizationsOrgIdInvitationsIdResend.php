<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Resend an invitation.
 *
 * Maps to POST /admin/realms/{realm}/organizations/{org-id}/invitations/{id}/resend in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmOrganizationsOrgIdInvitationsIdResend extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_invitations_id_resend',
  'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdInvitationsIdResend',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/invitations/{id}/resend',
  'summary' => 'Resend an invitation',
  'description' => 'Resend an invitation.',
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
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `id`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'org-id' => 'org_id',
    'id' => 'id',
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
