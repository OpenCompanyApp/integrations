<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get the identity provider factory for that provider id.
 *
 * Maps to GET /admin/realms/{realm}/identity-provider/providers/{provider_id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmIdentityProviderProvidersProviderId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_identity_provider_providers_provider_id',
  'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderProvidersProviderId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/identity-provider/providers/{provider_id}',
  'summary' => 'Get the identity provider factory for that provider id',
  'description' => 'Get the identity provider factory for that provider id.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'provider_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The provider id to get the factory',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'provider_id' => 'provider_id',
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
