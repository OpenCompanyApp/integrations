<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get configuration descriptions for all clients.
 *
 * Maps to GET /admin/realms/{realm}/authentication/per-client-config-description in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationPerClientConfigDescription extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_per_client_config_description',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationPerClientConfigDescription',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/per-client-config-description',
  'summary' => 'Get configuration descriptions for all clients',
  'description' => 'Get configuration descriptions for all clients.',
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
