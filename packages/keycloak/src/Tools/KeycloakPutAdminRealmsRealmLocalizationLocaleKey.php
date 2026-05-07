<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * PUT /admin/realms/{realm}/localization/{locale}/{key}.
 *
 * Maps to PUT /admin/realms/{realm}/localization/{locale}/{key} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmLocalizationLocaleKey extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_localization_locale_key',
  'class' => 'KeycloakPutAdminRealmsRealmLocalizationLocaleKey',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/localization/{locale}/{key}',
  'summary' => 'PUT /admin/realms/{realm}/localization/{locale}/{key}',
  'description' => 'PUT /admin/realms/{realm}/localization/{locale}/{key}.',
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
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
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
  'content_type' => 'text/plain',
  'type' => 'write',
);
}
