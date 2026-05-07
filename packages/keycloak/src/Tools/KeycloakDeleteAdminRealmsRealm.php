<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete the realm.
 *
 * Maps to DELETE /admin/realms/{realm} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealm extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm',
  'class' => 'KeycloakDeleteAdminRealmsRealm',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}',
  'summary' => 'Delete the realm',
  'description' => 'Delete the realm.',
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
  'type' => 'write',
);
}
