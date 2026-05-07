<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Create multiple mappers.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/add-models in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidProtocolMappersAddModels extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_protocol_mappers_add_models',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidProtocolMappersAddModels',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/protocol-mappers/add-models',
  'summary' => 'Create multiple mappers',
  'description' => 'Create multiple mappers.',
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
