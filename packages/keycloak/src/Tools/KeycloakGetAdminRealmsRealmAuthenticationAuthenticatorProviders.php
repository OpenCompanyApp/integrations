<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get authenticator providers Returns a stream of authenticator providers.
 *
 * Maps to GET /admin/realms/{realm}/authentication/authenticator-providers in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationAuthenticatorProviders extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_authenticator_providers',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationAuthenticatorProviders',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/authenticator-providers',
  'summary' => 'Get authenticator providers Returns a stream of authenticator providers',
  'description' => 'Get authenticator providers Returns a stream of authenticator providers.',
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
