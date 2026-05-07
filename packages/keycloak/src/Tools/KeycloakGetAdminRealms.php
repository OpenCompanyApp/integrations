<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get accessible realms Returns a list of accessible realms. The list is filtered based on what realms the caller is allowed to view.
 *
 * Maps to GET /admin/realms in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealms extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms',
  'class' => 'KeycloakGetAdminRealms',
  'method' => 'GET',
  'path' => '/admin/realms',
  'summary' => 'Get accessible realms Returns a list of accessible realms. The list is filtered based on what realms the caller is allowed to view',
  'description' => 'Get accessible realms Returns a list of accessible realms. The list is filtered based on what realms the caller is allowed to view.',
  'parameters' =>
  array (
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `briefRepresentation`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'briefRepresentation' => 'brief_representation',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
