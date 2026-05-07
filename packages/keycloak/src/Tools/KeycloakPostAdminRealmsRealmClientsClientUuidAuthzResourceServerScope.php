<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerScope extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_scope',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerScope',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope',
  'summary' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope',
  'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/scope.',
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
