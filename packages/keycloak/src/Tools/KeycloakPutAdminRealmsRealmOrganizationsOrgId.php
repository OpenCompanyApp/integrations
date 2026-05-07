<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Updates the organization.
 *
 * Maps to PUT /admin/realms/{realm}/organizations/{org-id} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmOrganizationsOrgId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_organizations_org_id',
  'class' => 'KeycloakPutAdminRealmsRealmOrganizationsOrgId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/organizations/{org-id}',
  'summary' => 'Updates the organization',
  'description' => 'Updates the organization.',
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
