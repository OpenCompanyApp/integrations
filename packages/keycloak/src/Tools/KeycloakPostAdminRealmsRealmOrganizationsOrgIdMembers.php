<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Adds the user with the specified id as a member of the organization.
 *
 * Maps to POST /admin/realms/{realm}/organizations/{org-id}/members in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmOrganizationsOrgIdMembers extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_members',
  'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdMembers',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/members',
  'summary' => 'Adds the user with the specified id as a member of the organization',
  'description' => 'Adds, or associates, an existing user with the organization. If no user is found, or if it is already associated with the organization, an error response is returned',
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
      'required' => true,
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
