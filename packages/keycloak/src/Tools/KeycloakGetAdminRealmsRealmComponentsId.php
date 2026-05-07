<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/components/{id}.
 *
 * Maps to GET /admin/realms/{realm}/components/{id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmComponentsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_components_id',
  'class' => 'KeycloakGetAdminRealmsRealmComponentsId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/components/{id}',
  'summary' => 'GET /admin/realms/{realm}/components/{id}',
  'description' => 'GET /admin/realms/{realm}/components/{id}.',
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
  'content_type' => NULL,
  'type' => 'read',
);
}
