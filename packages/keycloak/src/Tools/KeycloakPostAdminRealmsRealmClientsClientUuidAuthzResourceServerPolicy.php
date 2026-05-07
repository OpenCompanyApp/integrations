<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicy extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_authz_resource_server_policy',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicy',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy',
  'summary' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy',
  'description' => 'POST /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy.',
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
