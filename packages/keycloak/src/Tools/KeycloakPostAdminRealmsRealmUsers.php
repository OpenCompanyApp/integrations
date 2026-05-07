<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Create a new user Username must be unique.
 *
 * Maps to POST /admin/realms/{realm}/users in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmUsers extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_users',
  'class' => 'KeycloakPostAdminRealmsRealmUsers',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/users',
  'summary' => 'Create a new user Username must be unique',
  'description' => 'Create a new user Username must be unique.',
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
