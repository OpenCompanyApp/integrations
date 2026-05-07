<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Reaload keys for the identity provider if the provider supports it, "true" is returned if reload was performed, "false" if not.
 *
 * Maps to GET /admin/realms/{realm}/identity-provider/instances/{alias}/reload-keys in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasReloadKeys extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances_alias_reload_keys',
  'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasReloadKeys',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/reload-keys',
  'summary' => 'Reaload keys for the identity provider if the provider supports it, "true" is returned if reload was performed, "false" if not',
  'description' => 'Reaload keys for the identity provider if the provider supports it, "true" is returned if reload was performed, "false" if not.',
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
