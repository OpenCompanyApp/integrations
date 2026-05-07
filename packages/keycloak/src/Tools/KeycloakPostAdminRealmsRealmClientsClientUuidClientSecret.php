<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Generate a new secret for the client.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/client-secret in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidClientSecret extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_client_secret',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidClientSecret',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/client-secret',
  'summary' => 'Generate a new secret for the client',
  'description' => 'Generate a new secret for the client.',
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
