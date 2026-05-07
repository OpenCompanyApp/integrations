<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/providers.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/providers in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPermissionProviders extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_permission_providers',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPermissionProviders',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/providers',
  'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/providers',
  'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission/providers.',
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
