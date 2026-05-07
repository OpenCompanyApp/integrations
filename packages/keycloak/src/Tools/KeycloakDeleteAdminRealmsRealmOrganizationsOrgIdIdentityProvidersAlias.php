<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Removes the identity provider with the specified alias from the organization.
 *
 * Maps to DELETE /admin/realms/{realm}/organizations/{org-id}/identity-providers/{alias} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdIdentityProvidersAlias extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_organizations_org_id_identity_providers_alias',
  'class' => 'KeycloakDeleteAdminRealmsRealmOrganizationsOrgIdIdentityProvidersAlias',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/identity-providers/{alias}',
  'summary' => 'Removes the identity provider with the specified alias from the organization',
  'description' => 'Breaks the association between the identity provider and the organization. The provider itself is not deleted. If no provider is found, or if it is not currently associated with the org, an error response is returned',
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
  'type' => 'write',
);
}
