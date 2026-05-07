<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/components.
 *
 * Maps to GET /admin/realms/{realm}/components in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmComponents extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_components',
  'class' => 'KeycloakGetAdminRealmsRealmComponents',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/components',
  'summary' => 'GET /admin/realms/{realm}/components',
  'description' => 'GET /admin/realms/{realm}/components.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `name`.',
    ),
    'parent' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `parent`.',
    ),
    'provider_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `providerId`.',
    ),
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Keycloak query parameter `type`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'name' => 'name',
    'parent' => 'parent',
    'providerId' => 'provider_id',
    'type' => 'type',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
