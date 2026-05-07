<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Returns the organizations counts.
 *
 * Maps to GET /admin/realms/{realm}/organizations/count in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizationsCount extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations_count',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizationsCount',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations/count',
  'summary' => 'Returns the organizations counts',
  'description' => 'Returns the organizations counts.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'exact' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean which defines whether the param \'search\' must match exactly or not',
    ),
    'q' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A query to search for custom attributes, in the format \'key1:value2 key2:value2\'',
    ),
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A String representing either an organization name or domain',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'exact' => 'exact',
    'q' => 'q',
    'search' => 'search',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
