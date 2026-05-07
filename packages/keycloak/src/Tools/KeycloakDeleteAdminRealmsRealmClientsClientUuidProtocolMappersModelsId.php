<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete the mapper.
 *
 * Maps to DELETE /admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/models/{id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmClientsClientUuidProtocolMappersModelsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_protocol_mappers_models_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidProtocolMappersModelsId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/models/{id}',
  'summary' => 'Delete the mapper',
  'description' => 'Delete the mapper.',
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
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Mapper id',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
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
