<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update RequiredAction configuration.
 *
 * Maps to PUT /admin/realms/{realm}/authentication/required-actions/{alias}/config in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmAuthenticationRequiredActionsAliasConfig extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_authentication_required_actions_alias_config',
  'class' => 'KeycloakPutAdminRealmsRealmAuthenticationRequiredActionsAliasConfig',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}/config',
  'summary' => 'Update RequiredAction configuration',
  'description' => 'Update RequiredAction configuration.',
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
    'alias' => 'alias',
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
