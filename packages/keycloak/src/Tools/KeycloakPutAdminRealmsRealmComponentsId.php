<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * PUT /admin/realms/{realm}/components/{id}.
 *
 * Maps to PUT /admin/realms/{realm}/components/{id} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmComponentsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_components_id',
  'class' => 'KeycloakPutAdminRealmsRealmComponentsId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/components/{id}',
  'summary' => 'PUT /admin/realms/{realm}/components/{id}',
  'description' => 'PUT /admin/realms/{realm}/components/{id}.',
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
