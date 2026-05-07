<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Unregister a cluster node from the client.
 *
 * Maps to DELETE /admin/realms/{realm}/clients/{client-uuid}/nodes/{node} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmClientsClientUuidNodesNode extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_clients_client_uuid_nodes_node',
  'class' => 'KeycloakDeleteAdminRealmsRealmClientsClientUuidNodesNode',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/nodes/{node}',
  'summary' => 'Unregister a cluster node from the client',
  'description' => 'Unregister a cluster node from the client.',
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
    'node' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `node`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
    'node' => 'node',
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
