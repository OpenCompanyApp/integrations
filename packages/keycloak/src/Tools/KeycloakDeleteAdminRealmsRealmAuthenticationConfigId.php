<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete authenticator configuration.
 *
 * Maps to DELETE /admin/realms/{realm}/authentication/config/{id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmAuthenticationConfigId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_authentication_config_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmAuthenticationConfigId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/authentication/config/{id}',
  'summary' => 'Delete authenticator configuration',
  'description' => 'Delete authenticator configuration.',
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
  'type' => 'write',
);
}
