<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete the client.
 *
 * Maps to DELETE /admin/realms/{realm}/clients/{client-uuid} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmClientsClientUuid extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid',
  'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuid',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}',
  'summary' => 'Delete the client',
  'description' => 'Delete the client.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'client_uuid' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'id of client (not client-id!)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
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
