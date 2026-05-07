<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Import localization from uploaded JSON file.
 *
 * Maps to POST /admin/realms/{realm}/localization/{locale} in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmLocalizationLocale extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_localization_locale',
  'class' => 'KeycloakPostAdminRealmsRealmLocalizationLocale',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/localization/{locale}',
  'summary' => 'Import localization from uploaded JSON file',
  'description' => 'Import localization from uploaded JSON file.',
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
    'locale' => 'locale',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
