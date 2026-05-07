<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update required action.
 *
 * Maps to PUT /admin/realms/{realm}/authentication/required-actions/{alias} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmAuthenticationRequiredActionsAlias extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_authentication_required_actions_alias',
  'class' => 'KeycloakPutAdminRealmsRealmAuthenticationRequiredActionsAlias',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}',
  'summary' => 'Update required action',
  'description' => 'Update required action.',
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
