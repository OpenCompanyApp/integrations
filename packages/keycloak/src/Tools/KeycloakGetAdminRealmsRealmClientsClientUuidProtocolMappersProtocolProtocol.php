<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get mappers by name for a specific protocol.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/protocol/{protocol} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidProtocolMappersProtocolProtocol extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_protocol_mappers_protocol_protocol',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidProtocolMappersProtocolProtocol',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/protocol/{protocol}',
  'summary' => 'Get mappers by name for a specific protocol',
  'description' => 'Get mappers by name for a specific protocol.',
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
    'protocol' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `protocol`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
    'protocol' => 'protocol',
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
