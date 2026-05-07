<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Returns organization groups for the identity provider.
 *
 * Maps to GET /admin/realms/{realm}/organizations/{org-id}/identity-providers/{alias}/groups in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsOrgIdIdentityProvidersAliasGroups extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_org_id_identity_providers_alias_groups',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsOrgIdIdentityProvidersAliasGroups',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/{org-id}/identity-providers/{alias}/groups',
  'summary' => 'Returns organization groups for the identity provider',
  'description' => 'Returns organization groups that can be used in identity provider mappers. Only returns groups if the identity provider is associated with the organization.',
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
      'description' => 'The alias of the identity provider',
    ),
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'If true, return brief representation; otherwise return full representation',
    ),
    'exact' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'If true, perform exact match on the search parameter',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'The position of the first result (pagination offset)',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'The maximum number of results to return',
    ),
    'q' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A query to search for group attributes, in the format \'key1:value1 key2:value2\'',
    ),
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A string to search for in group names',
    ),
    'sub_groups_count' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'If true, include subgroups count in the response',
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
    'briefRepresentation' => 'brief_representation',
    'exact' => 'exact',
    'first' => 'first',
    'max' => 'max',
    'q' => 'q',
    'search' => 'search',
    'subGroupsCount' => 'sub_groups_count',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
