<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update the top-level information of the realm Any user, roles or client information in the representation will be ignored.
 *
 * Maps to PUT /admin/realms/{realm} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealm extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm',
  'class' => 'KeycloakPutAdminRealmsRealm',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}',
  'summary' => 'Update the top-level information of the realm Any user, roles or client information in the representation will be ignored',
  'description' => 'This will only update top-level attributes of the realm.',
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
