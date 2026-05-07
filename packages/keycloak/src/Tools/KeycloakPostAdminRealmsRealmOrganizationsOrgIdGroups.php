<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Creates a new top-level group or moves an existing group to top-level.
 *
 * Maps to POST /admin/realms/{realm}/organizations/{org-id}/groups in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmOrganizationsOrgIdGroups extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_groups',
  'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdGroups',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/groups',
  'summary' => 'Creates a new top-level group or moves an existing group to top-level',
  'description' => 'Creates a new top-level group in the organization. If the group representation includes an ID, moves the existing organization group to be a top-level group. If no ID is provided, creates a new top-level group.',
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}
