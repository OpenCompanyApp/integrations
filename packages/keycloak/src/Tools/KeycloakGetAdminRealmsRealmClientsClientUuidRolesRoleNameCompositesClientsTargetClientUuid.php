<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get client-level roles for the client that are in the role's composite.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/composites/clients/{targetClientUuid} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameCompositesClientsTargetClientUuid extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_roles_role_name_composites_clients_target_client_uuid',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidRolesRoleNameCompositesClientsTargetClientUuid',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/composites/clients/{targetClientUuid}',
  'summary' => 'Get client-level roles for the client that are in the role\'s composite',
  'description' => 'Get client-level roles for the client that are in the role\'s composite.',
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
    'role_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'role\'s name (not id!)',
    ),
    'target_client_uuid' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `targetClientUuid`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
    'role-name' => 'role_name',
    'targetClientUuid' => 'target_client_uuid',
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
