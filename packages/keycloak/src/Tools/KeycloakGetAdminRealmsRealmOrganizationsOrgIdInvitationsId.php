<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get invitation by ID.
 *
 * Maps to GET /admin/realms/{realm}/organizations/{org-id}/invitations/{id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsOrgIdInvitationsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_invitations_id',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdInvitationsId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/invitations/{id}',
  'summary' => 'Get invitation by ID',
  'description' => 'Get invitation by ID.',
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
  'type' => 'read',
);
}
