<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Create a new role for the realm or client.
 *
 * Maps to POST /admin/realms/{realm}/roles in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmRoles extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_roles',
  'class' => 'KeycloakPostAdminRealmsRealmRoles',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/roles',
  'summary' => 'Create a new role for the realm or client',
  'description' => 'Create a new role for the realm or client.',
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
