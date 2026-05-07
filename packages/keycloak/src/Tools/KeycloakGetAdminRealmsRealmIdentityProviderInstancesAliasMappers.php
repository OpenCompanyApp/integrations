<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get mappers for identity provider.
 *
 * Maps to GET /admin/realms/{realm}/identity-provider/instances/{alias}/mappers in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasMappers extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances_alias_mappers',
  'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasMappers',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/mappers',
  'summary' => 'Get mappers for identity provider',
  'description' => 'Get mappers for identity provider.',
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
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'alias' => 'alias',
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
