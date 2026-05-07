<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get RequiredAction provider configuration description.
 *
 * Maps to GET /admin/realms/{realm}/authentication/required-actions/{alias}/config-description in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationRequiredActionsAliasConfigDescription extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_required_actions_alias_config_description',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationRequiredActionsAliasConfigDescription',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}/config-description',
  'summary' => 'Get RequiredAction provider configuration description',
  'description' => 'Get RequiredAction provider configuration description.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'alias' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Alias of required action',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'alias' => 'alias',
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
