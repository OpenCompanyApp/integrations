<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete a mapper for the identity provider.
 *
 * Maps to DELETE /admin/realms/{realm}/identity-provider/instances/{alias}/mappers/{id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmIdentityProviderInstancesAliasMappersId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_identity_provider_instances_alias_mappers_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmIdentityProviderInstancesAliasMappersId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/mappers/{id}',
  'summary' => 'Delete a mapper for the identity provider',
  'description' => 'Delete a mapper for the identity provider.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'alias' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `alias`.',
    ),
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Mapper id',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'alias' => 'alias',
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
