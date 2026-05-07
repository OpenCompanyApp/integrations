<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/localization.
 *
 * Maps to GET /admin/realms/{realm}/localization in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmLocalization extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_localization',
  'class' => 'KeycloakGetAdminRealmsRealmLocalization',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/localization',
  'summary' => 'GET /admin/realms/{realm}/localization',
  'description' => 'GET /admin/realms/{realm}/localization.',
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
