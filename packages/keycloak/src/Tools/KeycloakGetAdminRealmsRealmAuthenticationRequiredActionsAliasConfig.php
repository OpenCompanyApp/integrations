<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get RequiredAction configuration.
 *
 * Maps to GET /admin/realms/{realm}/authentication/required-actions/{alias}/config in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationRequiredActionsAliasConfig extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_required_actions_alias_config',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationRequiredActionsAliasConfig',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}/config',
  'summary' => 'Get RequiredAction configuration',
  'description' => 'Get RequiredAction configuration.',
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
