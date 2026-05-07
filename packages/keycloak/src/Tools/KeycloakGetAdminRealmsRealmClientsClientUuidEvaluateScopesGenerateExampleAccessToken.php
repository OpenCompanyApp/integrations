<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Create JSON with payload of example access token.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/generate-example-access-token in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesGenerateExampleAccessToken extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_evaluate_scopes_generate_example_access_token',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidEvaluateScopesGenerateExampleAccessToken',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/evaluate-scopes/generate-example-access-token',
  'summary' => 'Create JSON with payload of example access token',
  'description' => 'Create JSON with payload of example access token.',
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
    'audience' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `audience`.',
    ),
    'scope' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `scope`.',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `userId`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'client-uuid' => 'client_uuid',
  ),
  'query_params' =>
  array (
    'audience' => 'audience',
    'scope' => 'scope',
    'userId' => 'user_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
