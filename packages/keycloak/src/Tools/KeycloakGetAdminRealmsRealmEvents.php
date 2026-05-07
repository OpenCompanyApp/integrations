<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get events Returns all events, or filters them based on URL query parameters listed here.
 *
 * Maps to GET /admin/realms/{realm}/events in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmEvents extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_events',
  'class' => 'KeycloakGetAdminRealmsRealmEvents',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/events',
  'summary' => 'Get events Returns all events, or filters them based on URL query parameters listed here',
  'description' => 'Get events Returns all events, or filters them based on URL query parameters listed here.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'client' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'App or oauth client name',
    ),
    'date_from' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'From (inclusive) date (yyyy-MM-dd) or time in Epoch timestamp millis (number of milliseconds since January 1, 1970, 00:00:00 GMT)',
    ),
    'date_to' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'To (inclusive) date (yyyy-MM-dd) or time in Epoch timestamp millis (number of milliseconds since January 1, 1970, 00:00:00 GMT)',
    ),
    'direction' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The direction to sort events by (asc or desc)',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Paging offset',
    ),
    'ip_address' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'IP Address',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Maximum results size (defaults to 100)',
    ),
    'type' =>
    array (
      'type' => 'array',
      'required' => false,
      'description' => 'The types of events to return',
    ),
    'user' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'User id',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'client' => 'client',
    'dateFrom' => 'date_from',
    'dateTo' => 'date_to',
    'direction' => 'direction',
    'first' => 'first',
    'ipAddress' => 'ip_address',
    'max' => 'max',
    'type' => 'type',
    'user' => 'user',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
