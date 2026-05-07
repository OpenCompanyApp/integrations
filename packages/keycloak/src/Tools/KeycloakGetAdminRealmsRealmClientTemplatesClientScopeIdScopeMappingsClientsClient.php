<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get the roles associated with a client's scope Returns roles for the client.
 *
 * Maps to GET /admin/realms/{realm}/client-templates/{client-scope-id}/scope-mappings/clients/{client} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsClientsClient extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_client_templates_client_scope_id_scope_mappings_clients_client',
  'class' => 'KeycloakGetAdminRealmsRealmClientTemplatesClientScopeIdScopeMappingsClientsClient',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/client-templates/{client-scope-id}/scope-mappings/clients/{client}',
  'summary' => 'Get the roles associated with a client\'s scope Returns roles for the client',
  'description' => 'Get the roles associated with a client\'s scope Returns roles for the client.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'client_scope_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `client-scope-id`.',
    ),
    'client' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `client`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-scope-id' => 'client_scope_id',
    'client' => 'client',
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
