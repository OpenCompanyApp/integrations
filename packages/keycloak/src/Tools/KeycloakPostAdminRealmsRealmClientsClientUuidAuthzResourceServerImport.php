<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/import.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/import in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerImport extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_import',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerImport',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/import',
  'summary' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/import',
  'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/import.',
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
