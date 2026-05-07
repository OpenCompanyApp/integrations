<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * DELETE /admin/realms/{realm}/localization/{locale}/{key}.
 *
 * Maps to DELETE /admin/realms/{realm}/localization/{locale}/{key} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmLocalizationLocaleKey extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_localization_locale_key',
  'class' => 'KeycloakDeleteAdminRealmsRealmLocalizationLocaleKey',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/localization/{locale}/{key}',
  'summary' => 'DELETE /admin/realms/{realm}/localization/{locale}/{key}',
  'description' => 'DELETE /admin/realms/{realm}/localization/{locale}/{key}.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'key' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `key`.',
    ),
    'locale' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `locale`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'key' => 'key',
    'locale' => 'locale',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
