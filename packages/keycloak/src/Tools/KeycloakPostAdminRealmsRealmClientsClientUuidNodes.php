<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Register a cluster node with the client Manually register cluster node to this client - usually it’s not needed to call this directly as adapter should handle by sending registration request to Keycloak.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/nodes in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidNodes extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_nodes',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidNodes',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/nodes',
  'summary' => 'Register a cluster node with the client Manually register cluster node to this client - usually it’s not needed to call this directly as adapter should handle by sending registration request to Keycloak',
  'description' => 'Register a cluster node with the client Manually register cluster node to this client - usually it’s not needed to call this directly as adapter should handle by sending registration request to Keycloak.',
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
