<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Test if registered cluster nodes are available Tests availability by sending 'ping' request to all cluster nodes.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/test-nodes-available in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidTestNodesAvailable extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_test_nodes_available',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidTestNodesAvailable',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/test-nodes-available',
  'summary' => 'Test if registered cluster nodes are available Tests availability by sending \'ping\' request to all cluster nodes',
  'description' => 'Test if registered cluster nodes are available Tests availability by sending \'ping\' request to all cluster nodes.',
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
