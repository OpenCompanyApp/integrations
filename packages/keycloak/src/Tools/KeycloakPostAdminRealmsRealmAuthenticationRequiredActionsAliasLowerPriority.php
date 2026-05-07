<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Lower required action's priority.
 *
 * Maps to POST /admin/realms/{realm}/authentication/required-actions/{alias}/lower-priority in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmAuthenticationRequiredActionsAliasLowerPriority extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_authentication_required_actions_alias_lower_priority',
  'class' => 'KeycloakPostAdminRealmsRealmAuthenticationRequiredActionsAliasLowerPriority',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/authentication/required-actions/{alias}/lower-priority',
  'summary' => 'Lower required action\'s priority',
  'description' => 'Lower required action\'s priority.',
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
