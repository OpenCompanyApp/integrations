<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get effective scope mapping of all roles of particular role container, which this client is defacto allowed to have in the accessToken issued for him.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/scope-mappings/{roleContainerId}/granted in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesScopeMappingsRoleContainerIdGranted extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_scope_mappings_role_container_id_granted',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesScopeMappingsRoleContainerIdGranted',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/scope-mappings/{roleContainerId}/granted',
  'summary' => 'Get effective scope mapping of all roles of particular role container, which this client is defacto allowed to have in the accessToken issued for him',
  'description' => 'This contains scope mappings, which this client has directly, as well as scope mappings, which are granted to all client scopes, which are linked with this client.',
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
    'role_container_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'either realm name OR client UUID',
    ),
    'scope' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `scope`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
    'roleContainerId' => 'role_container_id',
  ),
  'query_params' =>
  array (
    'scope' => 'scope',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
