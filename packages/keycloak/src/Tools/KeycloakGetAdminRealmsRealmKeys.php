<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/keys.
 *
 * Maps to GET /admin/realms/{realm}/keys in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmKeys extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_keys',
  'class' => 'KeycloakGetAdminRealmsRealmKeys',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/keys',
  'summary' => 'GET /admin/realms/{realm}/keys',
  'description' => 'GET /admin/realms/{realm}/keys.',
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
