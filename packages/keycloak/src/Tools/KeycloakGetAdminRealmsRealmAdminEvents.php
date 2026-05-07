<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get admin events Returns all admin events, or filters events based on URL query parameters listed here.
 *
 * Maps to GET /admin/realms/{realm}/admin-events in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAdminEvents extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_admin_events',
  'class' => 'KeycloakGetAdminRealmsRealmAdminEvents',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/admin-events',
  'summary' => 'Get admin events Returns all admin events, or filters events based on URL query parameters listed here',
  'description' => 'Get admin events Returns all admin events, or filters events based on URL query parameters listed here.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'auth_client' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `authClient`.',
    ),
    'auth_ip_address' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `authIpAddress`.',
    ),
    'auth_realm' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `authRealm`.',
    ),
    'auth_user' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'user id',
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
      'description' => 'Official Keycloak query parameter `first`.',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Maximum results size (defaults to 100)',
    ),
    'operation_types' =>
    array (
      'type' => 'array',
      'required' => false,
      'description' => 'Official Keycloak query parameter `operationTypes`.',
    ),
    'resource_path' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `resourcePath`.',
    ),
    'resource_types' =>
    array (
      'type' => 'array',
      'required' => false,
      'description' => 'Official Keycloak query parameter `resourceTypes`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'authClient' => 'auth_client',
    'authIpAddress' => 'auth_ip_address',
    'authRealm' => 'auth_realm',
    'authUser' => 'auth_user',
    'dateFrom' => 'date_from',
    'dateTo' => 'date_to',
    'direction' => 'direction',
    'first' => 'first',
    'max' => 'max',
    'operationTypes' => 'operation_types',
    'resourcePath' => 'resource_path',
    'resourceTypes' => 'resource_types',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
