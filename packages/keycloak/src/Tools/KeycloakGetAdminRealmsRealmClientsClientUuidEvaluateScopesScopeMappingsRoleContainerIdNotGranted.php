<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get roles, which this client doesn't have scope for and can't have them in the accessToken issued for him.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/scope-mappings/{roleContainerId}/not-granted in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesScopeMappingsRoleContainerIdNotGranted extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_scope_mappings_role_container_id_not_granted',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesScopeMappingsRoleContainerIdNotGranted',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/scope-mappings/{roleContainerId}/not-granted',
  'summary' => 'Get roles, which this client doesn\'t have scope for and can\'t have them in the accessToken issued for him',
  'description' => 'Defacto all the other roles of particular role container, which are not in {@link #getGrantedScopeMappings()}',
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
