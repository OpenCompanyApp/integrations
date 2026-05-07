<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get representation of the client.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuid extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuid',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}',
  'summary' => 'Get representation of the client',
  'description' => 'Get representation of the client.',
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
  'type' => 'read',
);
}
