<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Create a new authentication flow.
 *
 * Maps to POST /admin/realms/{realm}/authentication/flows in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmAuthenticationFlows extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_authentication_flows',
  'class' => 'KeycloakPostAdminRealmsRealmAuthenticationFlows',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/authentication/flows',
  'summary' => 'Create a new authentication flow',
  'description' => 'Create a new authentication flow.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
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
