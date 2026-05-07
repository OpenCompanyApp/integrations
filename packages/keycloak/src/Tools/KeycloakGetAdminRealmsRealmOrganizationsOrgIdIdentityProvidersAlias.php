<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Returns the identity provider associated with the organization that has the specified alias.
 *
 * Maps to GET /admin/realms/{realm}/organizations/{org-id}/identity-providers/{alias} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsOrgIdIdentityProvidersAlias extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_identity_providers_alias',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdIdentityProvidersAlias',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/identity-providers/{alias}',
  'summary' => 'Returns the identity provider associated with the organization that has the specified alias',
  'description' => 'Searches for an identity provider with the given alias. If one is found and is associated with the organization, it is returned. Otherwise, an error response with status NOT_FOUND is returned',
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
    'alias' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `alias`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'org-id' => 'org_id',
    'alias' => 'alias',
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
