<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update a client type.
 *
 * Maps to PUT /admin/realms/{realm}/client-types in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmClientTypes extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_client_types',
  'class' => 'KeycloakPutAdminRealmsRealmClientTypes',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/client-types',
  'summary' => 'Update a client type',
  'description' => 'This endpoint allows you to update a realm level client type',
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
