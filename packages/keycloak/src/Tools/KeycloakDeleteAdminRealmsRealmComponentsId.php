<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * DELETE /admin/realms/{realm}/components/{id}.
 *
 * Maps to DELETE /admin/realms/{realm}/components/{id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmComponentsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_components_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmComponentsId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/components/{id}',
  'summary' => 'DELETE /admin/realms/{realm}/components/{id}',
  'description' => 'DELETE /admin/realms/{realm}/components/{id}.',
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
  'type' => 'write',
);
}
