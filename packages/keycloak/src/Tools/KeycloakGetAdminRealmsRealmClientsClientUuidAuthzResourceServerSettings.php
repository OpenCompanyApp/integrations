<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/settings.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/settings in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerSettings extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_settings',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerSettings',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/settings',
  'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/settings',
  'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/settings.',
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
