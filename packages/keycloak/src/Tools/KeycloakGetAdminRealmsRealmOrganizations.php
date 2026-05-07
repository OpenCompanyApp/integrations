<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Returns a paginated list of organizations filtered according to the specified parameters.
 *
 * Maps to GET /admin/realms/{realm}/organizations in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmOrganizations extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_organizations',
  'class' => 'KeycloakGetAdminRealmsRealmOrganizations',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/organizations',
  'summary' => 'Returns a paginated list of organizations filtered according to the specified parameters',
  'description' => 'Returns a paginated list of organizations filtered according to the specified parameters.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'if false, return the full representation. Otherwise, only the basic fields are returned.',
    ),
    'exact' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean which defines whether the param \'search\' must match exactly or not',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'The position of the first result to be processed (pagination offset)',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'The maximum number of results to be returned - defaults to 10',
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
    'briefRepresentation' => 'brief_representation',
    'exact' => 'exact',
    'first' => 'first',
    'max' => 'max',
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
