<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete all events.
 *
 * Maps to DELETE /admin/realms/{realm}/events in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmEvents extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_events',
  'class' => 'KeycloakDeleteAdminRealmsRealmEvents',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/events',
  'summary' => 'Delete all events',
  'description' => 'Delete all events.',
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
  'type' => 'write',
);
}
