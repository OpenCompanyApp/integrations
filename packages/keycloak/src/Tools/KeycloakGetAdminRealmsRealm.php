<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get the top-level representation of the realm It will not include nested information like User and Client representations.
 *
 * Maps to GET /admin/realms/{realm} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealm extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm',
  'class' => 'KeycloakGetAdminRealmsRealm',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}',
  'summary' => 'Get the top-level representation of the realm It will not include nested information like User and Client representations',
  'description' => 'Get the top-level representation of the realm It will not include nested information like User and Client representations.',
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
