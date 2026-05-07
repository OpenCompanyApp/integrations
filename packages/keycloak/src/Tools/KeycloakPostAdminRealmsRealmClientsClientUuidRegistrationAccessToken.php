<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Generate a new registration access token for the client.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/registration-access-token in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidRegistrationAccessToken extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_registration_access_token',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidRegistrationAccessToken',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/registration-access-token',
  'summary' => 'Generate a new registration access token for the client',
  'description' => 'Generate a new registration access token for the client.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
