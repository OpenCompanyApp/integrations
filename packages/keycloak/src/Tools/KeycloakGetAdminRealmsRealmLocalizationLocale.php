<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/localization/{locale}.
 *
 * Maps to GET /admin/realms/{realm}/localization/{locale} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmLocalizationLocale extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_localization_locale',
  'class' => 'KeycloakGetAdminRealmsRealmLocalizationLocale',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/localization/{locale}',
  'summary' => 'GET /admin/realms/{realm}/localization/{locale}',
  'description' => 'GET /admin/realms/{realm}/localization/{locale}.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'locale' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `locale`.',
    ),
    'use_realm_default_locale_fallback' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `useRealmDefaultLocaleFallback`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'locale' => 'locale',
  ),
  'query_params' =>
  array (
    'useRealmDefaultLocaleFallback' => 'use_realm_default_locale_fallback',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
