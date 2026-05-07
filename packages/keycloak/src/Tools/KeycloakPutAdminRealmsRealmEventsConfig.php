<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * PUT /admin/realms/{realm}/events/config.
 *
 * Maps to PUT /admin/realms/{realm}/events/config in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmEventsConfig extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_events_config',
  'class' => 'KeycloakPutAdminRealmsRealmEventsConfig',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/events/config',
  'summary' => 'PUT /admin/realms/{realm}/events/config',
  'description' => 'Update the events provider Change the events provider and/or its configuration',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}
