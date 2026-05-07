<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * DELETE /admin/realms/{realm}/clients-initial-access/{id}.
 *
 * Maps to DELETE /admin/realms/{realm}/clients-initial-access/{id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmClientsInitialAccessId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_clients_initial_access_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmClientsInitialAccessId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/clients-initial-access/{id}',
  'summary' => 'DELETE /admin/realms/{realm}/clients-initial-access/{id}',
  'description' => 'DELETE /admin/realms/{realm}/clients-initial-access/{id}.',
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
      'description' => 'Official Keycloak path parameter `id`.',
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
