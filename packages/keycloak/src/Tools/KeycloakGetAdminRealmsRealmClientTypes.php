<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * List all client types available in the current realm.
 *
 * Maps to GET /admin/realms/{realm}/client-types in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientTypes extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_client_types',
  'class' => 'KeycloakGetAdminRealmsRealmClientTypes',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/client-types',
  'summary' => 'List all client types available in the current realm',
  'description' => 'This endpoint returns a list of both global and realm level client types and the attributes they set',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
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
