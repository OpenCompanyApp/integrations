<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get the events provider configuration Returns JSON object with events provider configuration.
 *
 * Maps to GET /admin/realms/{realm}/events/config in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmEventsConfig extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_events_config',
  'class' => 'KeycloakGetAdminRealmsRealmEventsConfig',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/events/config',
  'summary' => 'Get the events provider configuration Returns JSON object with events provider configuration',
  'description' => 'Get the events provider configuration Returns JSON object with events provider configuration.',
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
