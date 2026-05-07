<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update the mapper.
 *
 * Maps to PUT /admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/models/{id} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmClientsClientUuidProtocolMappersModelsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid_protocol_mappers_models_id',
  'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuidProtocolMappersModelsId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/models/{id}',
  'summary' => 'Update the mapper',
  'description' => 'Update the mapper.',
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
