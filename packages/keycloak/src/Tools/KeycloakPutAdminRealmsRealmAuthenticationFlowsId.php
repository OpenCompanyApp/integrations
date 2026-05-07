<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update an authentication flow.
 *
 * Maps to PUT /admin/realms/{realm}/authentication/flows/{id} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmAuthenticationFlowsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_authentication_flows_id',
  'class' => 'KeycloakPutAdminRealmsRealmAuthenticationFlowsId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/authentication/flows/{id}',
  'summary' => 'Update an authentication flow',
  'description' => 'Update an authentication flow.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `id`.',
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
    'id' => 'id',
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
