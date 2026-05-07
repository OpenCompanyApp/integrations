<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Import a realm. Imports a realm from a full representation of that realm.
 *
 * Maps to POST /admin/realms in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealms extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms',
  'class' => 'KeycloakPostAdminRealms',
  'method' => 'POST',
  'path' => '/admin/realms',
  'summary' => 'Import a realm. Imports a realm from a full representation of that realm',
  'description' => 'Realm name must be unique.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
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
