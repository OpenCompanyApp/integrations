<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get authentication flow for id.
 *
 * Maps to GET /admin/realms/{realm}/authentication/flows/{id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationFlowsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_flows_id',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationFlowsId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/flows/{id}',
  'summary' => 'Get authentication flow for id',
  'description' => 'Get authentication flow for id.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Flow id',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'id' => 'id',
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
