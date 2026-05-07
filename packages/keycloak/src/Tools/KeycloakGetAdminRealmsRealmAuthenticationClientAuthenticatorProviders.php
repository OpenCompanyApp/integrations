<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get client authenticator providers Returns a stream of client authenticator providers.
 *
 * Maps to GET /admin/realms/{realm}/authentication/client-authenticator-providers in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationClientAuthenticatorProviders extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_client_authenticator_providers',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationClientAuthenticatorProviders',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/client-authenticator-providers',
  'summary' => 'Get client authenticator providers Returns a stream of client authenticator providers',
  'description' => 'Get client authenticator providers Returns a stream of client authenticator providers.',
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
