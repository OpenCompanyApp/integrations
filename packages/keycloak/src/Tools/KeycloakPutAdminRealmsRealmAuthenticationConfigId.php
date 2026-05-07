<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update authenticator configuration.
 *
 * Maps to PUT /admin/realms/{realm}/authentication/config/{id} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmAuthenticationConfigId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_authentication_config_id',
  'class' => 'KeycloakPutAdminRealmsRealmAuthenticationConfigId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/authentication/config/{id}',
  'summary' => 'Update authenticator configuration',
  'description' => 'Update authenticator configuration.',
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
      'description' => 'Configuration id',
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
    'id' => 'id',
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
