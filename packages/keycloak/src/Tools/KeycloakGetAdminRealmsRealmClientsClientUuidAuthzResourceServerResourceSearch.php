<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/search.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/search in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceSearch extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_resource_search',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerResourceSearch',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/search',
  'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/search',
  'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/resource/search.',
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
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
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
  'content_type' => NULL,
  'type' => 'read',
);
}
