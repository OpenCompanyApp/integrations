<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * List workflows.
 *
 * Maps to GET /admin/realms/{realm}/workflows in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmWorkflows extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_workflows',
  'class' => 'KeycloakGetAdminRealmsRealmWorkflows',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/workflows',
  'summary' => 'List workflows',
  'description' => 'List workflows filtered by name and paginated using first and max parameters.',
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
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'A String representing the workflow name - either partial or exact',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'exact' => 'exact',
    'first' => 'first',
    'max' => 'max',
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
