<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Returns number of members in the organization.
 *
 * Maps to GET /admin/realms/{realm}/organizations/{org-id}/members/count in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersCount extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_members_count',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdMembersCount',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/members/count',
  'summary' => 'Returns number of members in the organization',
  'description' => 'Returns number of members in the organization.',
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
  'content_type' => NULL,
  'type' => 'read',
);
}
