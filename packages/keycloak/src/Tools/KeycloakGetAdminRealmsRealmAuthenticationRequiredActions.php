<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get required actions Returns a stream of required actions.
 *
 * Maps to GET /admin/realms/{realm}/authentication/required-actions in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationRequiredActions extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_required_actions',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationRequiredActions',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/required-actions',
  'summary' => 'Get required actions Returns a stream of required actions',
  'description' => 'Get required actions Returns a stream of required actions.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
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
