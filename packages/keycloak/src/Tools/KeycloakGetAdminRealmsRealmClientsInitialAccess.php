<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/clients-initial-access.
 *
 * Maps to GET /admin/realms/{realm}/clients-initial-access in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsInitialAccess extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_initial_access',
  'class' => 'KeycloakGetAdminRealmsRealmClientsInitialAccess',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients-initial-access',
  'summary' => 'GET /admin/realms/{realm}/clients-initial-access',
  'description' => 'GET /admin/realms/{realm}/clients-initial-access.',
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
