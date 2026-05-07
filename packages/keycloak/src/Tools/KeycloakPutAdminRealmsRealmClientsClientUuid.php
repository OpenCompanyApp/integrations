<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update the client.
 *
 * Maps to PUT /admin/realms/{realm}/clients/{client-uuid} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmClientsClientUuid extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid',
  'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuid',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}',
  'summary' => 'Update the client',
  'description' => 'Update the client.',
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
    'client-uuid' => 'client_uuid',
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
