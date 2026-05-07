<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Remove a specific user session.
 *
 * Maps to DELETE /admin/realms/{realm}/sessions/{session} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmSessionsSession extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_sessions_session',
  'class' => 'KeycloakDeleteAdminRealmsRealmSessionsSession',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/sessions/{session}',
  'summary' => 'Remove a specific user session',
  'description' => 'Any client that has an admin url will also be told to invalidate this particular session.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'session' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `session`.',
    ),
    'is_offline' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `isOffline`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'session' => 'session',
  ),
  'query_params' =>
  array (
    'isOffline' => 'is_offline',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
