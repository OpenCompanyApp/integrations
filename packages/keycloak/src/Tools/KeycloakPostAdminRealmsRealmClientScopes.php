<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Create a new client scope Client Scope’s name must be unique!.
 *
 * Maps to POST /admin/realms/{realm}/client-scopes in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientScopes extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_client_scopes',
  'class' => 'KeycloakPostAdminRealmsRealmClientScopes',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/client-scopes',
  'summary' => 'Create a new client scope Client Scope’s name must be unique!',
  'description' => 'Create a new client scope Client Scope’s name must be unique!.',
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
