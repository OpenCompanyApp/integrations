<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get authentication flows Returns a stream of authentication flows.
 *
 * Maps to GET /admin/realms/{realm}/authentication/flows in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationFlows extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_flows',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationFlows',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/flows',
  'summary' => 'Get authentication flows Returns a stream of authentication flows',
  'description' => 'Get authentication flows Returns a stream of authentication flows.',
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
