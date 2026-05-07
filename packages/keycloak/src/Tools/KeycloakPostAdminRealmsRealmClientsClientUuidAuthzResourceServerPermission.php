<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerPermission extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_permission',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerPermission',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission',
  'summary' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission',
  'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/permission.',
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
