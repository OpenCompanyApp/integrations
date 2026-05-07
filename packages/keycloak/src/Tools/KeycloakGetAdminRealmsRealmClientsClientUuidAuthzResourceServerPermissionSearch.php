<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/search.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/search in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPermissionSearch extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_permission_search',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPermissionSearch',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/search',
  'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/search',
  'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/search.',
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
    'fields' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `fields`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `name`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
  ),
  'query_params' =>
  array (
    'fields' => 'fields',
    'name' => 'name',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
