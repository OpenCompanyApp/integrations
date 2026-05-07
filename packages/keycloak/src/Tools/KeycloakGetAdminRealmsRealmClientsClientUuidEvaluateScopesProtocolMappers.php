<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Return list of all protocol mappers, which will be used when generating tokens issued for particular client.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/protocol-mappers in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesProtocolMappers extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_protocol_mappers',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesProtocolMappers',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/protocol-mappers',
  'summary' => 'Return list of all protocol mappers, which will be used when generating tokens issued for particular client',
  'description' => 'This means protocol mappers assigned to this client directly and protocol mappers assigned to all client scopes of this client.',
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
    'scope' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `scope`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
  ),
  'query_params' =>
  array (
    'scope' => 'scope',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
