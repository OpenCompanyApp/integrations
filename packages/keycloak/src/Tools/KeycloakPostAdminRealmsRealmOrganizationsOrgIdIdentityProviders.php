<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Adds the identity provider with the specified id to the organization.
 *
 * Maps to POST /admin/realms/{realm}/organizations/{org-id}/identity-providers in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmOrganizationsOrgIdIdentityProviders extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_organizations_org_id_identity_providers',
  'class' => 'KeycloakPostAdminRealmsRealmOrganizationsOrgIdIdentityProviders',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/identity-providers',
  'summary' => 'Adds the identity provider with the specified id to the organization',
  'description' => 'Adds, or associates, an existing identity provider with the organization. If no identity provider is found, or if it is already associated with the organization, an error response is returned',
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
