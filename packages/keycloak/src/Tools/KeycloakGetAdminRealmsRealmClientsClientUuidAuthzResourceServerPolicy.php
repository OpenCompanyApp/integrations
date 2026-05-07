<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicy extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_authz_resource_server_policy',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidAuthzResourceServerPolicy',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy',
  'summary' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy',
  'description' => 'GET /admin/realms/{realm}/clients/{client-uuid}/authz/resource-server/policy.',
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
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Official Keycloak query parameter `first`.',
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
    'permission' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `permission`.',
    ),
    'policy_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `policyId`.',
    ),
    'resource' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `resource`.',
    ),
    'resource_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `resourceType`.',
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
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
  ),
  'query_params' =>
  array (
    'fields' => 'fields',
    'first' => 'first',
    'max' => 'max',
    'name' => 'name',
    'owner' => 'owner',
    'permission' => 'permission',
    'policyId' => 'policy_id',
    'resource' => 'resource',
    'resourceType' => 'resource_type',
    'scope' => 'scope',
    'type' => 'type',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
