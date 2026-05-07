<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * DELETE /admin/realms/{realm}/localization/{locale}.
 *
 * Maps to DELETE /admin/realms/{realm}/localization/{locale} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmLocalizationLocale extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_localization_locale',
  'class' => 'KeycloakDeleteAdminRealmsRealmLocalizationLocale',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/localization/{locale}',
  'summary' => 'DELETE /admin/realms/{realm}/localization/{locale}',
  'description' => 'DELETE /admin/realms/{realm}/localization/{locale}.',
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
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
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
