<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}.
 *
 * Maps to PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_resource_id',
  'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceResourceId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}',
  'summary' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}',
  'description' => 'PUT /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/{resource-id}.',
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
      'required' => false,
      'description' => 'Official Keycloak query parameter `_id`.',
    ),
    'deep' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `deep`.',
    ),
    'exact_name' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `exactName`.',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Official Keycloak query parameter `first`.',
    ),
    'matching_uri' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `matchingUri`.',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Official Keycloak query parameter `max`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `name`.',
    ),
    'owner' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `owner`.',
    ),
    'scope' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `scope`.',
    ),
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `type`.',
    ),
    'uri' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `uri`.',
    ),
    'resource_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `resource-id`.',
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
    'resource-id' => 'resource_id',
  ),
  'query_params' =>
  array (
    '_id' => 'id',
    'deep' => 'deep',
    'exactName' => 'exact_name',
    'first' => 'first',
    'matchingUri' => 'matching_uri',
    'max' => 'max',
    'name' => 'name',
    'owner' => 'owner',
    'scope' => 'scope',
    'type' => 'type',
    'uri' => 'uri',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
