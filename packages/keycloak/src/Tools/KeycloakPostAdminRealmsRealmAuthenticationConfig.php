<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Create new authenticator configuration.
 *
 * Maps to POST /admin/realms/{realm}/authentication/config in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmAuthenticationConfig extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_authentication_config',
  'class' => 'KeycloakPostAdminRealmsRealmAuthenticationConfig',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/authentication/config',
  'summary' => 'Create new authenticator configuration',
  'description' => 'Create new authenticator configuration.',
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
