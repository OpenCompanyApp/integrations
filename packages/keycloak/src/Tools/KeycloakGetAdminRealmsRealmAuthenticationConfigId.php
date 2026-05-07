<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get authenticator configuration.
 *
 * Maps to GET /admin/realms/{realm}/authentication/config/{id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationConfigId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_config_id',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationConfigId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/config/{id}',
  'summary' => 'Get authenticator configuration',
  'description' => 'Get authenticator configuration.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Configuration id',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'id' => 'id',
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
