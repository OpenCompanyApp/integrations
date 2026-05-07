<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get required action for alias.
 *
 * Maps to GET /admin/realms/{realm}/authentication/required-actions/{alias} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationRequiredActionsAlias extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_required_actions_alias',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationRequiredActionsAlias',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}',
  'summary' => 'Get required action for alias',
  'description' => 'Get required action for alias.',
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
