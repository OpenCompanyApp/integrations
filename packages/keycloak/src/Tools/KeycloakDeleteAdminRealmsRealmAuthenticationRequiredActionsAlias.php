<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete required action.
 *
 * Maps to DELETE /admin/realms/{realm}/authentication/required-actions/{alias} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmAuthenticationRequiredActionsAlias extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_authentication_required_actions_alias',
  'class' => 'KeycloakDeleteAdminRealmsRealmAuthenticationRequiredActionsAlias',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}',
  'summary' => 'Delete required action',
  'description' => 'Delete required action.',
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
  'type' => 'write',
);
}
