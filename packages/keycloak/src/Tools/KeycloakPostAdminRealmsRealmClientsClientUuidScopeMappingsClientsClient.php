<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Add client-level roles to the client's scope.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/scope-mappings/clients/{client} in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidScopeMappingsClientsClient extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_scope_mappings_clients_client',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidScopeMappingsClientsClient',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/scope-mappings/clients/{client}',
  'summary' => 'Add client-level roles to the client\'s scope',
  'description' => 'Add client-level roles to the client\'s scope.',
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
    'client' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `client`.',
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
    'client' => 'client',
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
