<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get mapper by id for the identity provider.
 *
 * Maps to GET /admin/realms/{realm}/identity-provider/instances/{alias}/mappers/{id} in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasMappersId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances_alias_mappers_id',
  'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasMappersId',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/mappers/{id}',
  'summary' => 'Get mapper by id for the identity provider',
  'description' => 'Get mapper by id for the identity provider.',
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
      'description' => 'Official Keycloak path parameter `id`.',
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
  'type' => 'read',
);
}
