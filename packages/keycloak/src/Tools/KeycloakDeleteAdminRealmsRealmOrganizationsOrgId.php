<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Deletes the organization.
 *
 * Maps to DELETE /admin/realms/{realm}/organizations/{org-id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmOrganizationsOrgId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_organizations_org_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmOrganizationsOrgId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/organizations/{org-id}',
  'summary' => 'Deletes the organization',
  'description' => 'Deletes the organization.',
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
  'type' => 'write',
);
}
