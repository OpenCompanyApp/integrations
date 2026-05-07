<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/credential-registrators.
 *
 * Maps to GET /admin/realms/{realm}/credential-registrators in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmCredentialRegistrators extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_credential_registrators',
  'class' => 'KeycloakGetAdminRealmsRealmCredentialRegistrators',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/credential-registrators',
  'summary' => 'GET /admin/realms/{realm}/credential-registrators',
  'description' => 'GET /admin/realms/{realm}/credential-registrators.',
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
