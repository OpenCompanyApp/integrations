<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get authenticator provider's configuration description.
 *
 * Maps to GET /admin/realms/{realm}/authentication/config-description/{providerId} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationConfigDescriptionProviderId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_config_description_provider_id',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationConfigDescriptionProviderId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/config-description/{providerId}',
  'summary' => 'Get authenticator provider\'s configuration description',
  'description' => 'Get authenticator provider\'s configuration description.',
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
      'description' => 'Official Keycloak path parameter `providerId`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'providerId' => 'provider_id',
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
