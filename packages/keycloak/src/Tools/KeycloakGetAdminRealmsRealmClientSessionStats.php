<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get client session stats Returns a JSON map.
 *
 * Maps to GET /admin/realms/{realm}/client-session-stats in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientSessionStats extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_client_session_stats',
  'class' => 'KeycloakGetAdminRealmsRealmClientSessionStats',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/client-session-stats',
  'summary' => 'Get client session stats Returns a JSON map',
  'description' => 'The key is the client id, the value is the number of sessions that currently are active with that client. Only clients that actually have a session associated with them will be in this map.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
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
