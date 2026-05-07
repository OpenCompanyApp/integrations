<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete all admin events.
 *
 * Maps to DELETE /admin/realms/{realm}/admin-events in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmAdminEvents extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_admin_events',
  'class' => 'KeycloakDeleteAdminRealmsRealmAdminEvents',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/admin-events',
  'summary' => 'Delete all admin events',
  'description' => 'Delete all admin events.',
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
