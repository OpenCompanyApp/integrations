<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Export public broker configuration for identity provider.
 *
 * Maps to GET /admin/realms/{realm}/identity-provider/instances/{alias}/export in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasExport extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances_alias_export',
  'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasExport',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/export',
  'summary' => 'Export public broker configuration for identity provider',
  'description' => 'Export public broker configuration for identity provider.',
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
    'format' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Format to use',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'alias' => 'alias',
  ),
  'query_params' =>
  array (
    'format' => 'format',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
